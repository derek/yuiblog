---
layout: layouts/post.njk
title: "CSS Quick Tip: How to prevent a \"float drop\" in IE6"
author: "Thierry Koblentz"
date: 2010-10-28
slug: "css-quick-tip-how-to-prevent-a-float-drop-in-ie6"
permalink: /blog/2010/10/28/css-quick-tip-how-to-prevent-a-float-drop-in-ie6/
categories:
  - "Development"
---
Even though this behavior is often called a "[float drop](http://www.positioniseverything.net/explorer/expandingboxbug.html "Internet Explorer 6 and the Expanding Box Problem ")" or a "drop float", the column that drops does _not_ have to be a float...it only has to be wider than the space allocated for it. Note that this is by spec and it's a common behavior across browsers; if a column is "too wide", then it will drop.

What makes IE 6 _stand out_ is that this browser does not fully support the `width` property (nor `height` for that matter). Hence, it lets containers grow to accommodate their content. It is this growth that creates the drop, because the box can't fit into its designed space.

Usually, the culprits are elements that do not wrap (e.g. images, urls, etc.), but font styling (e.g., [IE and italics](http://www.positioniseverything.net/explorer/italicbug-ie.html)) may be responsible too.

For example, to make the right column drop on [YUIBlog](/blog-archive/ "Yahoo! User Interface Blog (YUIBlog)") in IE 6, all I had to do is to style one of the images in the right rail with a width greater than 210 pixels. That image forces IE 6 to increase the width of the right column which then can no longer fit next to the left column.

![The right column drops below the main content](/yuiblog/blog-archive/assets/dropfloat/column-drop.png)

## The usual fixes:

`word-wrap: break-word;`

Strings wrap by breaking at the right edge of the box.

`wbr` with `wbr:after {content:"\00200B"}` for Opera

The `wbr` element represents a line break opportunity. Inserting `wbr`s inside long strings allows the browser to add a line break if needed.

`overflow-x:hidden;`

Any content wider than the container is cut-off at the right edge of the said box.

Note that the two first solutions only work on strings and won't prevent images, etc. from expanding the box.

## When known fixes fail short

A few weeks back, I was asked to fix a "float drop" on one of the Yahoo! Finance pages. In modern browsers, a long string was [sticking out of the right rail](/yuiblog/blog-archive/assets/dropfloat/modern-browsers.png) (screenshot), but in IE 6 that same string made the right column drop [below the fold](/yuiblog/blog-archive/assets/dropfloat/ie6.png) (screenshot). Unfortunately, that content came from a provider, so editing the markup was not an option.

Because of the nature of the string, which was a comma-separated list of symbols, the fixes above were not satisfactory. Breaking that list in an arbitrary place was better than cutting it off, but still not a viable solution...

## Making IE 6 behave like the big boys

The trick to make IE 6 behave like any modern browsers out there is to style the box with a **negative** right margin (plus `position:relative`).

## Live Demo

### Without the fix

[Screenshot](/yuiblog/blog-archive/assets/dropfloat/demo.png) for those who do not see this page in IE 6.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis facilisis viverra. Curabitur luctus, nibh ac rhoncus ultrices, turpis mauris mattis dui, quis pharetra odio orci vitae risus. Nunc ultricies gravida facilisis.

![Yahoo! Logo](/yuiblog/blog-archive/assets/dropfloat/logo.png)

Curabitur luctus, quis orci vitae risus.

### With the fix

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis facilisis viverra. Curabitur luctus, nibh ac rhoncus ultrices, turpis mauris mattis dui, quis pharetra odio orci vitae risus. Nunc ultricies gravida facilisis.

![Yahoo! Logo](/yuiblog/blog-archive/assets/dropfloat/logo.png)

Curabitur luctus, quis orci vitae risus.

```

.fixMe {
  margin-right:-100px;
  position:relative;
}


```

The negative margin can be of any value as long as this value is greater than the delta between the allocated width and the actual width of the expanded box. It is that declaration that prevents the drop float. The purpose of `position:relative` is to make IE show the content outside of the boundaries of the parent container.

Because I like to style elements the same across the board, I usually do not sandbox this rule.

## Things to consider

This hack keeps the column in place, but it does _not_ prevent that container from getting wider. This means you cannot style the element with a background or a border because they would be painted outside of the wrapper. Here's a screenshot of what background and border look like when applied in combination with this technique in IE 6:

![](/yuiblog/blog-archive/assets/dropfloat/demo-with-background.png)