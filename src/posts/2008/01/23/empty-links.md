---
layout: layouts/post.njk
title: "Empty Links and Screen Readers"
author: "Mike Davies"
date: 2008-01-23
slug: "empty-links"
permalink: /2008/01/23/empty-links/
categories:
  - "Development"
---
With the help of other members of the Yahoo! Accessibility Stakeholders group, I ran a screen reader test to establish whether links that contain no link text were an accessibility barrier. We tested a number of approaches to hiding links across a typical range of screen reader and browsers.

The conclusion is that the most accessible link is one that contains link text. Different techniques of hiding links, from no link text, through to hiding by CSS can cause an accessibility barrier to screen reader users. Each screen reader presented its user with a different set of problems and barriers.

What follows is a detail description of the test, tabulated results, summary of techniques that passed, failed or came close, and a list of web development recommendations.

### The Microformats include pattern

The Microformats group have created an [include pattern](http://microformats.org/wiki/include-pattern) which is a mechanism for including a portion of data from one area of a page into another area on the same page. Essentially, it's a means of preventing the duplication of data.

A good example of this is a page that lists all the reviews done by one person. Instead of every review having to duplicate the reviewer details, we can use the include pattern to define the reviewer once, and include it into each review. No needless duplication.

The main technique being advocated as an include is the humble link, but in an effort to minimise duplication of content, the example is an empty link; a link with no link text:

```

<a class="include" href="#author" title="James Levine"></a>


```

The current accessibility understanding is that empty links can present a barrier to screen reader users. The Microformats group have attempted to solve this problem by using the title attribute to offer something a screen reader can use to announce a link.

The issue here is to find a way of marking up a microformat include pattern that's accessible to screen reader users.

### Test cases

I produced 18 test cases covering a wide range of techniques to hide a link from being displayed. These tests covered:

-   Normal links with proper link text
-   Links with no link text or title attribute
-   Links with a title, but no link text
-   Links containing just whitespace for text

Each type of link was styled in the following ways:

-   Displayed in a default manner
-   Positioned off-screen
-   Visibility of hidden
-   Display set to none

The tests were carried out by three screen reader users. Two of them are super-users of screen readers, so consequently have a great deal of experience and knowledge that can allow them to work around many difficult accessibility issues. Interestingly, neither of them had their main screen reader set up to read out both the link text and the title. Both of them have multiple screen readers installed. The third tester was a web developer with a deep understanding of using screen readers.

Ideally, we'd need more screen reader users to create a decent sample, including non-power users, but the results we saw are fairly consistent.

### Success criteria

There are two screen reader behaviours that form a successful test case. The first was that a link was read out normally, as if it were an inline link within a paragraph of text. The second successful behaviour was that the screen reader does not announce the presence of a link and just skips over it.

### The test results

We covered four major screen reader versions over three different browsers. The results for each combination can be seen in the following table. The result cells are colour coded to quickly highlight techniques that are safe to use:

-   Red-coloured cells indicates buggy behaviour or the output was likely to frustrate the screen reader user.
-   Amber-coloured cells indicate that the technique did work, but relies on stylesheets to hide the link from screen readers.
-   Light green-coloured cells indicate the technique did work, but relies on particular configurations of a screen reader.
-   Green-coloured cells indicate that the technique did work, and did not rely on stylesheets or a particular screen reader configuration.

All the information conveyed in colour is also available in the table footnotes and the notes below.

#### Tables for each browser combination

Link results for JAWS 8.0 and JAWS 7.10 with Internet Explorer 64
| type of link | default | offscreen | `visibility: hidden` | `display: none` |
| --- | --- | --- | --- | --- |
| Normal | text | text | nothing | nothing |
| empty | `href` | `href` | `href` | nothing |
| empty with `title` | `title` | `title` | `href` | nothing |
| whitespace | `href` | `href` | `href` | nothing |
| whitespace with `title` | `title` | `title` | `href` | nothing |

Link results for JAWS 8.0 and Firefox 2
| type of link | default | offscreen | `visibility: hidden` | `display: none` |
| --- | --- | --- | --- | --- |
| Normal | text | text | nothing | nothing |
| empty | absolute `href` | absolute `href` | absolute `href` | nothing |
| empty with `title` | `title` | `title` | absolute `href`, `title` | nothing |
| whitespace | `href` | buggy1 | absolute `href` | nothing |
| whitespace with `title` | `title` | buggy1 | absolute `href`, `title` | nothing |

Link results for JAWS 9.0 with Internet Explorer 6
| type of link | default | offscreen | `visibility: hidden` | `display: none` |
| --- | --- | --- | --- | --- |
| Normal | text | text | nothing | nothing |
| empty | `href` | `href` | nothing | nothing |
| empty with `title` | `title` | `title` | nothing | nothing |
| whitespace | nothing2 | nothing2 | nothing | nothing |
| whitespace with `title` | `title` | `title` | nothing | nothing |

Link results for Window-Eyes 6.1 with Internet Explorer 6
| type of link | default | offscreen | `visibility: hidden` | `display: none` |
| --- | --- | --- | --- | --- |
| Normal | text | text | nothing | nothing |
| empty | `href` | `href` | nothing | `href` |
| empty with `title` | `title` | `title` | nothing | nothing |
| whitespace | nothing2 | `href` | nothing | nothing |
| whitespace with `title` | nothing2 | nothing2 | nothing | nothing |

Link results for Window-Eyes 6.1 with Internet Explorer 7
| type of link | default | offscreen | `visibility: hidden` | `display: none` |
| --- | --- | --- | --- | --- |
| Normal | text | text | nothing | nothing |
| empty | "empty", `href`3 | "empty", `href`3 | nothing | "empty", `href`3 |
| empty with `title` | `title` | `title` | nothing | nothing |
| whitespace | nothing2 | nothing2 | nothing | nothing |
| whitespace with `title` | nothing2 | nothing2 | nothing | nothing |

#### Footnotes to the tables

-   1\. buggy means the screen reader reacted as if there were two separate links instead of just an empty link.
-   2\. nothing means that the screen reader announces there's a link, but there's no link text read out.
-   3\. "empty", href means the screen reader reads out the word "empty" followed by the contents of the `href` attribute
-   4\. In JAWS 8.0 with Internet Explorer when a list of links was displayed, the links could not be reordered alphabetically. We tried both a different page, and with JAWS 7.10, and that worked fine. Empty links breaks JAWS 8.10 ability to sort links when listed.

### Test case failures (code red)

The following is a list of failures and buggy behaviour:

-   An empty linked styled with `display none` caused the `href` attribute of the link to be read out in Window Eyes 6.1
-   An empty link styled to `visibility: hidden` caused the `href` attribute to be read out in JAWS 7.10 and JAWS 8.0 in Internet Explorer and Firefox 2. With Firefox, JAWS 8.0 read out the absolute URL of the link.
-   An empty link regardless of styling (apart from `display: none`) caused the `href` attribute to be read out in JAWS 7.10 and JAWS 8.0 on both Internet Explorer and Firefox. Again, JAWS 8.0 with Firefox read out the absolute URL of the link.
-   A link containing whitespace as link text caused the `href` attribute to be read out in JAWS 7.10 and JAWS 8.0 in Internet Explorer and Firefox.
-   With JAWS 8.0 and Firefox we saw a buggy behaviour where a link containing just whitespace as link text was actually read out as two separate links.
-   With Window Eyes 6.1 and Internet Explorer 6 we saw buggy behaviour where a link containing just whitespace and a `title` attribute, but styled to appear offscreen, the `href` attribute was read out even though there was a `title` attribute present.

### Test cases relying on stylesheets (code amber)

All of the test cases that relied either on the `display` or `visibility` styles to hide the link from the screen reader did succeed (except for the failures noted above, for example the handling of `visibility` is exceptionally buggy in JAWS).

When CSS is not enabled, or the styles are ignored by the screen reader, the behaviour falls back to the default case.

### Test cases relying on screen reader configuration (code light green)

Test cases using the `title` attribute worked when the screen reader was configured to read out `title` attributes. Both our experienced screen reader users had changed their screen reader configuration to read out `title`s on links when there was no actual link text. Unfortunately, this is not sufficient to conclude that this is a majority preference.

Thus, techniques using the `title` attribute are reliant on a specific screen reader configuration to work as expected. This configuration cannot be assured, and cannot be relied on.

Test cases designed to hide the link from a screen reader by not supplying any link text fail when the screen reader configuration is set to announce links. Announcing links gets the screen reader to preface all link text with the word 'Link'. Empty links that successfully dodge screen reader heuristics and produce no link text still run into the frustrating problem of a link being announced, but no text associated with that link.

### Passed test cases (code green)

Only two of the eighteen test cases resulted in an unqualified pass:

-   A normal text link with default styling
-   A normal text link displayed offscreen. (Links displayed offscreen are still announced by the screen reader)

### Conclusion

Not using proper link text forces the browser and screen reader to fallback to heuristics in an attempt to determine what the link text should be. Internet Explorer decides to offer the `title` attribute, and failing that, it tries to extract something readable from the `href` attribute. JAWS 8 with Firefox 2 on the other hand reads out the absolute URL of the page, followed by, if available, the `title` attribute; or if the `title` attribute is not available, it extracts something readable from the `href` attribute.

There are breakages in JAWS 8.0/IE6 and Windows Eyes with IE6, when the link text is empty. We observed that a screen reader user could not alphabetically sort a list of links in JAWS 8.0, and so this creates a barrier to quickly finding a link, a barrier that wasn't there before, and it's the markup that provokes/uncovers this bug.

Windows Eyes also has problems with empty text links, falling back to reading out the `href` attribute, and uniquely reads out the link `href` when the link is styled with `display: none`.

An empty link with a `title` attribute, styled with `display: none` looks to be a feasible option, but flounders because of two ungrounded assumptions:

-   CSS will always be enabled on browsers communicating with screen readers
-   The `title` attribute is configured to be read out by screen readers.

Neither of these assumptions realistically hold, nor can be relied on.

### Web Developer Recommendations

-   Always have proper link text for a link, and assure that the link text makes sense in context. At that point the link can then be hidden by positioning it offscreen. If the link is styled with `display` set to `none`, ensure that the content makes sense with and without the link text in place.
-   Never have an anchor with jusst an `href` attribute. The screen reader fallback is to read out the entire URL or try to extrapolate something readable from it, or a combination of both. This can lead to unpredictable results. How a browser or screen reader translates a URL into text that is read out requires more extensive testing.
-   Never use `visibility: hidden` to hide an empty link from view. This leads to the `title` attribute being ignored in both JAWS/IE6 set-ups, and the absolute URL of the link being read out with Firefox. It also introduces a dependency on CSS to prevent an accessibility barrier.
-   Never use just white space as the link text, the choice of link text between the setups tested differ significantly, with all combinations creating an accessibility barrier - either of reading an entire absolute URL, or guessing the link text based on URL extrapolation, or as in Window Eyes announcing a link, but with no link text read out.
-   Never use `display: none` as a means of hiding this link. This creates a dependency on CSS, since the rendering of the page in screen readers is degraded.
-   Never rely on the `title` attribute as the sole means of providing a form of link text since it's inconclusive whether `title` attributes are enabled for all screen reader users.

### Resources

-   [Test cases](/yuiblog/blog-archive/assets/emptylinks.html): The 18 test cases that we used for this experiment. This will allow interested parties to re-run these tests and confirm the findings.

Thank you to Artur Ortega and Victor Tsaran (both of the Yahoo! Accessibility Stakeholders Group) for volunteering time to run these test cases and talk through the issues they encountered - that process was enlightening and informative. Thanks to Ben Hawkes Lewis for his insight and guidance on screen reader usage, also for volunteering to run these tests through his screen readers, and his support of running this experiment. Finally, thanks to Ben Ward for taking the initiative to understand and resolve the accessibility implications of certain markup techniques, and for providing me with an interesting problem to tackle.