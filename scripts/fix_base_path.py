#!/usr/bin/env python3
"""
Fix absolute paths for hosting at /yuiblog/ subpath on GitHub Pages.
Changes paths like /css/ to /yuiblog/css/
"""

import os
import re
from pathlib import Path

BASE_DIR = Path(__file__).parent.parent
BASE_PATH = '/yuiblog'

# Patterns to fix (paths that need the base path prefix)
PATH_PATTERNS = [
    # CSS and assets
    (r'href="/(css/)', f'href="{BASE_PATH}/\\1'),
    (r'href="/(vendor/)', f'href="{BASE_PATH}/\\1'),
    (r'href="/(combo/)', f'href="{BASE_PATH}/\\1'),
    (r'href="/(favicon\.ico)', f'href="{BASE_PATH}/\\1'),
    
    # Internal links
    (r'href="/(blog/)', f'href="{BASE_PATH}/\\1'),
    (r'href="/(page/)', f'href="{BASE_PATH}/\\1'),
    (r'href="/"', f'href="{BASE_PATH}/"'),
    
    # Also fix single-quoted versions
    (r"href='/(css/)", f"href='{BASE_PATH}/\\1"),
    (r"href='/(vendor/)", f"href='{BASE_PATH}/\\1"),
    (r"href='/(combo/)", f"href='{BASE_PATH}/\\1"),
    (r"href='/(blog/)", f"href='{BASE_PATH}/\\1"),
    (r"href='/(page/)", f"href='{BASE_PATH}/\\1"),
    (r"href='/'", f"href='{BASE_PATH}/'"),
    
    # Archive dropdown values
    (r"value='/(blog/)", f"value='{BASE_PATH}/\\1"),
    (r'value="/(blog/)', f'value="{BASE_PATH}/\\1'),
]

def fix_html_file(filepath):
    """Fix paths in a single HTML file."""
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
        
        original_content = content
        
        for pattern, replacement in PATH_PATTERNS:
            content = re.sub(pattern, replacement, content)
        
        if content != original_content:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            return True
        return False
    except Exception as e:
        print(f"Error processing {filepath}: {e}")
        return False

def main():
    """Find and fix all HTML files."""
    html_files = list(BASE_DIR.rglob('*.html'))
    # Exclude original/ directory
    html_files = [f for f in html_files if 'original' not in str(f)]
    
    print(f"Found {len(html_files)} HTML files")
    print(f"Adding base path: {BASE_PATH}")
    print()
    
    fixed_count = 0
    for i, filepath in enumerate(html_files):
        if fix_html_file(filepath):
            fixed_count += 1
        
        if (i + 1) % 500 == 0:
            print(f"Processed {i + 1}/{len(html_files)} files...")
    
    print(f"\nDone! Fixed paths in {fixed_count} files.")

if __name__ == '__main__':
    main()
