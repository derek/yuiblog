module.exports = function(eleventyConfig) {
  // Pass through static assets
  eleventyConfig.addPassthroughCopy("src/assets");
  eleventyConfig.addPassthroughCopy("src/css");
  eleventyConfig.addPassthroughCopy("src/vendor");
  eleventyConfig.addPassthroughCopy("src/combo");
  eleventyConfig.addPassthroughCopy("src/favicon.ico");
  eleventyConfig.addPassthroughCopy("src/wp-content");
  eleventyConfig.addPassthroughCopy({"src/assets": "blog-archive/assets"});

  // Date formatting filters
  eleventyConfig.addFilter("dateDisplay", function(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
  });

  eleventyConfig.addFilter("dateISO", function(date) {
    return new Date(date).toISOString().split('T')[0];
  });

  eleventyConfig.addFilter("year", function(date) {
    return new Date(date).getFullYear();
  });

  eleventyConfig.addFilter("month", function(date) {
    return String(new Date(date).getMonth() + 1).padStart(2, '0');
  });

  eleventyConfig.addFilter("day", function(date) {
    return String(new Date(date).getDate()).padStart(2, '0');
  });

  // Collection: All posts sorted by date
  eleventyConfig.addCollection("posts", function(collectionApi) {
    return collectionApi.getFilteredByGlob("src/posts/**/*.md").sort((a, b) => {
      return b.date - a.date;
    });
  });

  // Collection: Posts by category
  eleventyConfig.addCollection("categories", function(collectionApi) {
    const posts = collectionApi.getFilteredByGlob("src/posts/**/*.md");
    const categories = {};
    
    posts.forEach(post => {
      const cats = post.data.categories || [];
      cats.forEach(cat => {
        if (!categories[cat]) {
          categories[cat] = [];
        }
        categories[cat].push(post);
      });
    });

    // Sort posts within each category by date
    Object.keys(categories).forEach(cat => {
      categories[cat].sort((a, b) => b.date - a.date);
    });

    return categories;
  });

  // Collection: Posts by author
  eleventyConfig.addCollection("authors", function(collectionApi) {
    const posts = collectionApi.getFilteredByGlob("src/posts/**/*.md");
    const authors = {};
    
    posts.forEach(post => {
      const author = post.data.author || "Unknown";
      if (!authors[author]) {
        authors[author] = [];
      }
      authors[author].push(post);
    });

    // Sort posts within each author by date
    Object.keys(authors).forEach(author => {
      authors[author].sort((a, b) => b.date - a.date);
    });

    return authors;
  });

  // Slugify filter for URLs
  eleventyConfig.addFilter("slugify", function(str) {
    return str
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/(^-|-$)/g, '');
  });

  // Limit filter for arrays
  eleventyConfig.addFilter("limit", function(arr, limit) {
    return arr.slice(0, limit);
  });

  // Prepend base URL to paths
  eleventyConfig.addFilter("url", function(path) {
    if (!path) return '/yuiblog/';
    // Remove leading slash if present, then prepend base
    const cleanPath = path.replace(/^\//, '');
    return '/yuiblog/' + cleanPath;
  });

  // Excerpt filter - extracts first paragraph or N characters from HTML content
  eleventyConfig.addFilter("excerpt", function(content, length = 200) {
    if (!content) return '';
    
    // Strip HTML tags
    let text = content.replace(/<[^>]+>/g, ' ');
    // Normalize whitespace
    text = text.replace(/\s+/g, ' ').trim();
    // Decode HTML entities
    text = text.replace(/&amp;/g, '&')
               .replace(/&lt;/g, '<')
               .replace(/&gt;/g, '>')
               .replace(/&quot;/g, '"')
               .replace(/&#39;/g, "'");
    
    if (text.length <= length) return text;
    
    // Cut at word boundary
    let excerpt = text.substring(0, length);
    const lastSpace = excerpt.lastIndexOf(' ');
    if (lastSpace > length * 0.8) {
      excerpt = excerpt.substring(0, lastSpace);
    }
    return excerpt + '...';
  });

  // Add prev/next navigation filters
  eleventyConfig.addFilter("getPreviousCollectionItem", function(collection, page) {
    const index = collection.findIndex(item => item.url === page.url);
    return index > 0 ? collection[index - 1] : null;
  });

  eleventyConfig.addFilter("getNextCollectionItem", function(collection, page) {
    const index = collection.findIndex(item => item.url === page.url);
    return index < collection.length - 1 ? collection[index + 1] : null;
  });

  // Configuration
  return {
    dir: {
      input: "src",
      output: "_site",
      includes: "_includes",
      data: "_data"
    },
    templateFormats: ["md", "njk", "html"],
    markdownTemplateEngine: "njk",
    htmlTemplateEngine: "njk",
    pathPrefix: "/yuiblog/"
  };
};
