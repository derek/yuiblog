# YUI Blog Archive

This is a static archive of the YUI Blog (yuiblog.com), preserving blog posts from the Yahoo User Interface Library team from 2006-2014.

## About

The YUI Blog was the official blog for the Yahoo User Interface Library, one of the pioneering JavaScript libraries that helped shape modern web development. The blog featured:

- Technical articles on JavaScript, CSS, and web development
- Release announcements for YUI versions
- YUI Theater videos featuring talks from industry leaders like Douglas Crockford
- Community contributions and "In the Wild" showcases
- YUIConf conference coverage

## Archive Contents

- **~1,200 blog posts** spanning 2006-2014
- **Category pages** for browsing by topic
- **Paginated homepage** for chronological browsing

## Hosting

This is a static HTML site that can be hosted on any static file server:

### GitHub Pages

1. Push to a GitHub repository
2. Enable GitHub Pages in repository settings
3. Select the main branch as source

### Local Development

```bash
# Using Python
python3 -m http.server 8000

# Using Node.js
npx serve .
```

Then visit `http://localhost:8000`

## Structure

```
yuiblog/
├── index.html          # Blog homepage with recent posts
├── page/               # Pagination pages
├── blog/               # Blog posts organized by date
│   ├── YYYY/MM/DD/slug/
│   └── category/       # Category pages
├── css/                # Stylesheets
├── vendor/             # Third-party libraries (YUI grids)
└── combo/              # Combined CSS
```

## License

Original content copyright Yahoo! Inc. This archive is preserved for historical and educational purposes.

## Credits

- Original blog maintained by the YUI team at Yahoo
- Archive reconstructed by Derek Gathright
