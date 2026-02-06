const fs = require('fs');
const path = require('path');
const cheerio = require('cheerio');
const TurndownService = require('turndown');
const { gfm } = require('turndown-plugin-gfm');

// Initialize Turndown with GitHub Flavored Markdown
const turndown = new TurndownService({
  headingStyle: 'atx',
  codeBlockStyle: 'fenced',
  bulletListMarker: '-'
});
turndown.use(gfm);

// Custom rule for preserving code blocks
turndown.addRule('pre', {
  filter: 'pre',
  replacement: function(content, node) {
    const code = node.querySelector('code');
    const lang = code ? (code.className.match(/language-(\w+)/) || [])[1] : '';
    const text = node.textContent;
    return '\n```' + (lang || '') + '\n' + text + '\n```\n';
  }
});

// Custom rule for preserving iframes (YouTube embeds, etc.)
turndown.addRule('iframe', {
  filter: 'iframe',
  replacement: function(content, node) {
    // Return the iframe as raw HTML
    return '\n\n' + node.outerHTML + '\n\n';
  }
});

// Custom rule for preserving embed and object tags
turndown.addRule('embed', {
  filter: ['embed', 'object'],
  replacement: function(content, node) {
    return '\n\n' + node.outerHTML + '\n\n';
  }
});

// Directories
const BLOG_DIR = path.join(__dirname, '..', 'blog');
const OUTPUT_DIR = path.join(__dirname, '..', 'src', 'posts');
const AUTHORS_FILE = path.join(__dirname, '..', 'src', '_data', 'authors.json');

// Track authors for generating authors.json
const authorsMap = {};

// Parse date from URL path like /2007/06/12/
function parseDateFromPath(filePath) {
  const match = filePath.match(/blog\/(\d{4})\/(\d{2})\/(\d{2})\//);
  if (match) {
    return `${match[1]}-${match[2]}-${match[3]}`;
  }
  return null;
}

// Extract slug from path
function extractSlug(filePath) {
  const match = filePath.match(/blog\/\d{4}\/\d{2}\/\d{2}\/([^/]+)\//);
  if (match) {
    // Sanitize slug - remove newlines and other problematic characters
    return match[1].replace(/[\n\r\t]/g, '').trim();
  }
  return null;
}

// Check if path is a blog post (not a listing/archive page)
function isBlogPost(filePath) {
  // Blog posts have format: blog/YYYY/MM/DD/slug/index.html
  return /blog\/\d{4}\/\d{2}\/\d{2}\/[^/]+\/index\.html$/.test(filePath);
}

// Extract author name from meta section
function extractAuthor($) {
  // Try various selectors for author
  let author = null;
  
  // Try author link first (most reliable)
  const authorLink = $('.meta a.name, .meta .author a, .meta a').first();
  if (authorLink.length) {
    author = authorLink.text().replace(/^By\s*/i, '').trim();
  }
  
  // Try "By AuthorName" pattern from text
  if (!author) {
    const metaText = $('.meta').text();
    // Match "By Name" but stop before dates (month names or numbers)
    const byMatch = metaText.match(/By\s+([A-Za-z][A-Za-z\s.'-]+?)(?=\s*(?:January|February|March|April|May|June|July|August|September|October|November|December|\d))/i);
    if (byMatch) {
      author = byMatch[1].trim();
    }
  }
  
  // Clean up author name
  if (author) {
    author = author.replace(/^By\s*/i, '').trim();
    // Remove any trailing punctuation
    author = author.replace(/[,.]$/, '').trim();
    // Remove any date-like suffixes
    author = author.replace(/\s*\d{1,2}.*$/, '').trim();
  }
  
  return author || 'YUI Team';
}

// Extract categories from breadcrumbs or body class
function extractCategories($, filePath) {
  const categories = [];
  
  // Try breadcrumbs
  $('.breadcrumbs a').each((i, el) => {
    const href = $(el).attr('href') || '';
    if (href.includes('/category/')) {
      const text = $(el).text().trim();
      if (text && !categories.includes(text)) {
        categories.push(text);
      }
    }
  });
  
  // Try body class
  if (categories.length === 0) {
    const bodyClass = $('body').attr('class') || '';
    const catMatches = bodyClass.match(/category-([^\s]+)/g);
    if (catMatches) {
      catMatches.forEach(match => {
        const catSlug = match.replace('category-', '');
        // Convert slug to title case
        const catName = catSlug.split('-').map(word => 
          word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
        if (!categories.includes(catName)) {
          categories.push(catName);
        }
      });
    }
  }
  
  return categories;
}

// Extract title
function extractTitle($) {
  let title = null;
  
  // Try the main content h1 first (more specific)
  const contentH1 = $('.content h1, #main h1, .entry h1').first();
  if (contentH1.length) {
    title = contentH1.text().trim();
  }
  
  // Try breadcrumbs last item
  if (!title || title === 'YUI Blog') {
    const breadcrumb = $('.breadcrumbs li.current, .breadcrumbs li:last-child').last();
    if (breadcrumb.length) {
      title = breadcrumb.text().trim();
    }
  }
  
  // Fall back to title tag
  if (!title || title === 'YUI Blog') {
    title = $('title').text().trim();
    // Remove site name suffix
    title = title.replace(/\s*\|\s*YUI Blog.*$/i, '').trim();
  }
  
  // Skip generic titles
  if (title === 'YUI Blog' || title === 'Home') {
    title = null;
  }
  
  return title || 'Untitled';
}

// Extract main content
function extractContent($) {
  const blogContent = $('#blog-content');
  
  if (blogContent.length) {
    // Remove navigation elements
    blogContent.find('.navigation').remove();
    blogContent.find('.interview .intro').remove(); // Remove author bio intros
    
    // Remove gravatar images
    blogContent.find('img[src*="gravatar"]').remove();
    
    return blogContent.html();
  }
  
  // Fallback to entry content
  const entry = $('.entry').first();
  if (entry.length) {
    entry.find('.meta').remove();
    entry.find('.navigation').remove();
    // Remove gravatar images
    entry.find('img[src*="gravatar"]').remove();
    return entry.html();
  }
  
  return '';
}

// Generate excerpt from content
function generateExcerpt(markdown) {
  // Get first paragraph
  const lines = markdown.split('\n').filter(line => line.trim());
  for (const line of lines) {
    // Skip headings, code blocks, images
    if (!line.startsWith('#') && !line.startsWith('```') && !line.startsWith('![')) {
      const excerpt = line.substring(0, 300);
      return excerpt + (line.length > 300 ? '...' : '');
    }
  }
  return '';
}

// Process a single HTML file
function processFile(filePath) {
  const html = fs.readFileSync(filePath, 'utf8');
  const $ = cheerio.load(html);
  
  // Extract metadata
  const title = extractTitle($);
  const author = extractAuthor($);
  const date = parseDateFromPath(filePath);
  const slug = extractSlug(filePath);
  const categories = extractCategories($, filePath);
  
  if (!date || !slug) {
    console.log(`Skipping (no date/slug): ${filePath}`);
    return null;
  }
  
  // Extract and convert content
  const htmlContent = extractContent($);
  if (!htmlContent) {
    console.log(`Skipping (no content): ${filePath}`);
    return null;
  }
  
  const markdown = turndown.turndown(htmlContent);
  const excerpt = generateExcerpt(markdown);
  
  // Track author
  if (!authorsMap[author]) {
    authorsMap[author] = { name: author, postCount: 0 };
  }
  authorsMap[author].postCount++;
  
  // Build frontmatter
  const frontmatter = [
    '---',
    `layout: layouts/post.njk`,
    `title: "${title.replace(/"/g, '\\"')}"`,
    `author: "${author}"`,
    `date: ${date}`,
    `slug: "${slug}"`,
    `permalink: /blog/${date.replace(/-/g, '/')}/${slug}/`.replace(/\/\//g, '/'),
  ];
  
  if (categories.length > 0) {
    frontmatter.push('categories:');
    categories.forEach(cat => {
      frontmatter.push(`  - "${cat}"`);
    });
  }
  
  // Skip excerpt - it can cause YAML parsing issues and isn't essential
  // The content itself serves as the excerpt in templates
  
  frontmatter.push('---');
  frontmatter.push('');
  
  return {
    content: frontmatter.join('\n') + markdown,
    date,
    slug,
    title,
    author
  };
}

// Find all blog post files
function findBlogPosts(dir) {
  const posts = [];
  
  function walk(currentDir) {
    const files = fs.readdirSync(currentDir);
    
    for (const file of files) {
      const filePath = path.join(currentDir, file);
      const stat = fs.statSync(filePath);
      
      if (stat.isDirectory()) {
        // Skip certain directories
        if (!['original', 'node_modules', '_site', 'src'].includes(file)) {
          walk(filePath);
        }
      } else if (file === 'index.html' && isBlogPost(filePath)) {
        posts.push(filePath);
      }
    }
  }
  
  walk(dir);
  return posts;
}

// Main migration function
function migrate() {
  console.log('Starting migration...\n');
  
  // Find all blog posts
  const posts = findBlogPosts(BLOG_DIR);
  console.log(`Found ${posts.length} blog posts to migrate\n`);
  
  let migrated = 0;
  let skipped = 0;
  
  for (const postPath of posts) {
    try {
      const result = processFile(postPath);
      
      if (result) {
        // Create output directory
        const [year, month, day] = result.date.split('-');
        const outputDir = path.join(OUTPUT_DIR, year, month, day);
        fs.mkdirSync(outputDir, { recursive: true });
        
        // Write markdown file
        const outputPath = path.join(outputDir, `${result.slug}.md`);
        fs.writeFileSync(outputPath, result.content);
        
        migrated++;
        if (migrated % 100 === 0) {
          console.log(`Migrated ${migrated} posts...`);
        }
      } else {
        skipped++;
      }
    } catch (err) {
      console.error(`Error processing ${postPath}: ${err.message}`);
      skipped++;
    }
  }
  
  // Write authors.json
  const authorsList = Object.values(authorsMap).sort((a, b) => b.postCount - a.postCount);
  fs.writeFileSync(AUTHORS_FILE, JSON.stringify(authorsList, null, 2));
  
  console.log(`\nMigration complete!`);
  console.log(`- Migrated: ${migrated} posts`);
  console.log(`- Skipped: ${skipped} files`);
  console.log(`- Authors found: ${authorsList.length}`);
}

// Run migration
migrate();
