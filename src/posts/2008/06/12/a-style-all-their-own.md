---
layout: layouts/post.njk
title: "A Style All Their Own"
author: "Luke Smith"
date: 2008-06-12
slug: "a-style-all-their-own"
permalink: /blog/2008/06/12/a-style-all-their-own/
categories:
  - "Development"
---
Modifying a DOM element's style during user interaction is one of the pillars of creating DHTML interfaces that transition from state to state in a smooth, and (hopefully) intuitive way. Every HTMLElement in the DOM contains `style`, a collection of properties corresponding to the CSS properties understood by the browser. For JavaScript and CSS enabled browsers, the following two paragraphs would contain red text:

```
<-- Paragraph 1 -->
<p style="color: #f00">This paragraph is red</p>

<-- Paragraph 2 -->
<p id="x">This paragraph's color will be red after the JavaScript runs</p>
<script type="text/javascript">
(function () {
    var el = document.getElementById('x');

    el.style.color = '#f00';

})();
</script>

```

Even CSS properties that aren't applicable to a given element will have representation in that element's `style` collection. For example, even the `<br>` element will have the `el.style.letterSpacing` property.

### Names have been changed to protect the innocent

The style property names in JavaScript are camel cased versions of their CSS counterparts, so `font-family` in CSS becomes `el.style.fontFamily` in the style collection. "float" is a reserved word in JavaScript, so the CSS float property is given a different name. In Internet Explorer, `styleFloat` is used, where Firefox, Safari, and Opera all use `cssFloat` (Opera also supports `styleFloat`, actually). Additionally, each browser has a host of proprietary CSS properties that also show up in the style collection (e.g. `-moz-border-radius`, which becomes `el.style.MozBorderRadius` in Firefox). Other than `styleFloat`/`cssFloat`, the browser vendors largely agree on non-proprietary property names.

### The madness and the method

I set out to document which properties were present in each A Grade browser's `style` collection (making no claims about their functional support for specific values).

For each browser, I used a simple `for (var prop in el.style)` method to iterate the style collection, and cross checked in a development tool if available. Specifically, I used the following:

| Browser | Method |
| --- | --- |
| Internet Explorer 6 | `for ( in )` and Visual Web Developer 2008 Express Edition |
| Internet Explorer 7 | `for ( in )` and Visual Web Developer 2008 Express Edition |
| Firefox 2.0.0.14 | `for ( in )` and FireBug 1.1 |
| Firefox 3 (Release Candidate 2) | `for ( in )` and FireBug 1.1 |
| Safari 3.1.1 (WebKit build 4525.18) | Dom Inspector\* |
| Opera 9.27 | `for ( in )` |
| Opera 9.5 (beta and GA) | `for ( in )` and Opera Dragonfly |

**\*** - Safari does not enumerate unassigned style properties, so `for ( in )` doesn't show anything useful.

All tests were done on a Macbook Pro running OSX 10.4. The IEs and FF2 were tested on Parallels instances running Windows XP. I only documented properties that weren't prefixed with a vendor identifier (e.g. -moz), and omitted methods and meta fields such as `setProperty` and `length`. The only exception to this being `cssText`, which I'll talk more about later. So without further ado...

[![](/yuiblog/blog-archive/assets/lukecss.png)](/blog-archive/)

[Click through to see the full table of CSS properties](/blog-archive/).

table { border-bottom: 1px solid #ccc; empty-cells: show; font-size: 77%; } th { border-bottom: .3em solid #ccc; color: #777; vertical-align: bottom; font-size: 150%; font-weight: bold; padding: 0 .75ex; line-height: .5; } th.col1 { border-left:ne; padding-left: .75ex; } td { border-right: 1px solid #ccc; text-align: center; padding: .25ex 1ex; } code { font-weight: bold; background: #ddd; } .altRow { background-color: #eef; } .col1 { border-left: 1px solid #ccc; padding: 0 1ex; text-align: left; } .common .col1, span.common { background-color: #ff8; } .no { background-color: #700; color: #fff; } .indent { margin-left: 1.5em; } .indent2x { margin-left: 3em; } /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

### Style properties across A Grade (plus a few) browsers

Properties with gold backgrounds are present in all tested browsers.

| Property | IE6 | IE7 | FF2 | FF3 | S3 | Op9.27 | Op9.5 |
| --- | --- | --- | --- | --- | --- | --- | --- |
| accelerator | Y | Y | N | N | N | N | N |
| alignmentBaseline | N | N | N | N | Y | N | Y |
| azimuth | N | N | Y | Y | N | N | N |
| background | Y | Y | Y | Y | Y | Y | Y |
| Attachment | Y | Y | Y | Y | Y | Y | Y |
| Color | Y | Y | Y | Y | Y | Y | Y |
| Image | Y | Y | Y | Y | Y | Y | Y |
| Position | Y | Y | Y | Y | Y | Y | Y |
| X | Y | Y | N | N | N | N | N |
| Y | Y | Y | N | N | N | N | N |
| Repeat | Y | Y | Y | Y | Y | Y | Y |
| baselineShift | N | N | N | N | Y | N | Y |
| behavior | Y | Y | N | N | N | N | N |
| border | Y | Y | Y | Y | Y | Y | Y |
| Top, Right, Bottom, Left | Y | Y | Y | Y | Y | Y | Y |
| Color | Y | Y | Y | Y | Y | Y | Y |
| Style | Y | Y | Y | Y | Y | Y | Y |
| Width | Y | Y | Y | Y | Y | Y | Y |
| Color | Y | Y | Y | Y | Y | Y | Y |
| Style | Y | Y | Y | Y | Y | Y | Y |
| Width | Y | Y | Y | Y | Y | Y | Y |
| Collapse | Y | Y | Y | Y | Y | Y | Y |
| Spacing | N | N | Y | Y | N | Y | Y |
| bottom | Y | Y | Y | Y | Y | Y | Y |
| boxSizing | N | N | N | N | N | N | Y |
| captionSide | N | N | Y | Y | Y | Y | Y |
| clear | Y | Y | Y | Y | Y | Y | Y |
| clip | Y | Y | Y | Y | Y | Y | Y |
| Path | N | N | N | N | Y | N | Y |
| Rule | N | N | N | N | Y | N | Y |
| color | Y | Y | Y | Y | Y | Y | Y |
| Interpolation | N | N | N | N | Y | N | Y |
| Filters | N | N | N | N | Y | N | Y |
| Profile | N | N | N | N | N | N | Y |
| Rendering | N | N | N | N | Y | N | Y |
| columnSpan | N | N | N | N | N | N | Y |
| content | N | N | Y | Y | N | Y | Y |
| counterIncrement | N | N | Y | Y | N | Y | Y |
| counterReset | N | N | Y | Y | N | Y | Y |
| cssFloat | N | N | Y | Y | Y | Y | Y |
| cssText \*\*\* | Y | Y | Y | Y | Y | Y | Y |
| cue | N | N | Y | Y | N | N | N |
| After | N | N | Y | Y | N | N | N |
| Before | N | N | Y | Y | N | N | N |
| cursor | Y | Y | Y | Y | Y | Y | Y |
| direction | Y | Y | Y | Y | Y | Y | Y |
| display | Y | Y | Y | Y | Y | Y | Y |
| displayAlign | N | N | N | N | N | N | Y |
| dominantBaseline | N | N | N | N | N | N | Y |
| elevation | N | N | Y | Y | N | N | N |
| emptyCells | N | N | Y | Y | Y | Y | Y |
| enableBackground | N | N | N | N | N | N | Y |
| fill | N | N | N | N | Y | N | Y |
| Opacity | N | N | N | N | Y | N | Y |
| Rule | N | N | N | N | Y | N | Y |
| filter | Y | Y | N | N | Y | N | Y |
| floodColor | N | N | N | N | Y | N | Y |
| floodOpacity | N | N | N | N | Y | N | Y |
| font | Y | Y | Y | Y | Y | Y | Y |
| Family | Y | Y | Y | Y | Y | Y | Y |
| Size | Y | Y | Y | Y | Y | Y | Y |
| Adjust | N | N | Y | Y | N | Y | Y |
| Stretch | N | N | Y | Y | N | Y | Y |
| Style | Y | Y | Y | Y | Y | Y | Y |
| Variant | Y | Y | Y | Y | Y | Y | Y |
| Weight | Y | Y | Y | Y | Y | Y | Y |
| glyphOrientationHorizontal | N | N | N | N | N | N | Y |
| glyphOrientationVertical | N | N | N | N | N | N | Y |
| height | Y | Y | Y | Y | Y | Y | Y |
| imageRendering | N | N | N | N | N | N | Y |
| imeMode | Y | Y | N | Y | N | N | N |
| kerning | N | N | N | N | N | N | Y |
| layoutFlow | Y | Y | N | N | N | N | N |
| layoutGrid | Y | Y | N | N | N | N | N |
| Char | Y | Y | N | N | N | N | N |
| Line | Y | Y | N | N | N | N | N |
| Mode | Y | Y | N | N | N | N | N |
| Type | Y | Y | N | N | N | N | N |
| left | Y | Y | Y | Y | Y | Y | Y |
| letterSpacing | Y | Y | Y | Y | Y | Y | Y |
| lightingColor | N | N | N | N | Y | N | Y |
| lineBreak | Y | Y | N | N | N | N | N |
| lineHeight | Y | Y | Y | Y | Y | Y | Y |
| lineIncrement | N | N | N | N | N | N | Y |
| listStyle | Y | Y | Y | Y | N | Y | Y |
| Image | Y | Y | Y | Y | Y | Y | Y |
| Position | Y | Y | Y | Y | Y | Y | Y |
| Type | Y | Y | Y | Y | Y | Y | Y |
| margin | Y | Y | Y | Y | N | Y | Y |
| Top, Right, Bottom, Left | Y | Y | Y | Y | Y | Y | Y |
| markerEnd | N | N | N | N | Y | N | Y |
| markerMid | N | N | N | N | Y | N | Y |
| markerOffset | N | N | Y | Y | N | Y | Y |
| markerStart | N | N | N | N | Y | N | Y |
| marks | N | N | Y | Y | N | Y | Y |
| mask | N | N | N | N | Y | N | Y |
| maxHeight | N | Y | Y | Y | Y | Y | Y |
| maxWidth | N | Y | Y | Y | Y | Y | Y |
| minHeight | Y | Y | Y | Y | Y | Y | Y |
| minWidth | N | Y | Y | Y | Y | Y | Y |
| navDown | N | N | N | N | N | N | Y |
| navIndex | N | N | N | N | N | N | Y |
| navLeft | N | N | N | N | N | N | Y |
| navRight | N | N | N | N | N | N | Y |
| navUp | N | N | N | N | N | N | Y |
| opacity | N | N | Y | Y | Y | Y | Y |
| orphans | N | N | Y | Y | Y | Y | Y |
| outline | N | N | Y | Y | N | Y | Y |
| Color | N | N | Y | Y | Y | Y | Y |
| Offset | N | N | Y | Y | N | N | Y |
| Style | N | N | Y | Y | Y | Y | Y |
| Width | N | N | Y | Y | Y | Y | Y |
| overflow | Y | Y | Y | Y | Y | Y | Y |
| X | Y | Y | Y | Y | Y | N | Y |
| Y | Y | Y | Y | Y | Y | N | Y |
| padding | Y | Y | Y | Y | Y | Y | Y |
| Top, Right, Bottom, Left | Y | Y | Y | Y | Y | Y | Y |
| page | N | N | Y | Y | N | Y | Y |
| BreakAfter | Y | Y | Y | Y | Y | Y | Y |
| BreakBefore | Y | Y | Y | Y | Y | Y | Y |
| BreakInside | N | N | Y | Y | Y | Y | Y |
| pause | N | N | Y | Y | N | Y | Y |
| After | N | N | Y | Y | N | Y | Y |
| Before | N | N | Y | Y | N | Y | Y |
| pitch | N | N | Y | Y | N | N | N |
| Range | N | N | Y | Y | N | Y | Y |
| pointerEvents | N | N | N | N | Y | N | Y |
| position | Y | Y | Y | Y | Y | Y | Y |
| quotes | N | N | Y | Y | N | Y | Y |
| resize | N | N | N | N | Y | N | N |
| richness | N | N | Y | Y | N | N | N |
| right | Y | Y | Y | Y | Y | Y | Y |
| rowSpan | N | N | N | N | N | N | Y |
| rubyAlign | Y | Y | N | N | N | N | N |
| rubyOverhang | Y | Y | N | N | N | N | N |
| rubyPosition | Y | Y | N | N | N | N | N |
| scrollbar3dlightColor | Y | Y | N | N | N | N | Y |
| scrollbarArrowColor | Y | Y | N | N | N | N | Y |
| scrollbarBaseColor | Y | Y | N | N | N | N | Y |
| scrollbarDarkShadowColor | Y | Y | N | N | N | N | N |
| scrollbarDarkshadowColor | N | N | N | N | N | N | Y |
| scrollbarFaceColor | Y | Y | N | N | N | N | Y |
| scrollbarHighlightColor | Y | Y | N | N | N | N | Y |
| scrollbarShadowColor | Y | Y | N | N | N | N | Y |
| scrollbarTrackColor | Y | Y | N | N | N | N | Y |
| shapeRendering | N | N | N | N | Y | N | Y |
| size | N | N | Y | Y | N | Y | Y |
| solidColor | N | N | N | N | N | N | Y |
| solidOpacity | N | N | N | N | N | N | Y |
| speak | N | N | Y | Y | N | Y | Y |
| Header | N | N | Y | Y | N | N | N |
| Numeral | N | N | Y | Y | N | N | N |
| Punctuation | N | N | Y | Y | N | N | N |
| speechRate | N | N | Y | Y | N | Y | Y |
| stopColor | N | N | N | N | Y | N | Y |
| stopOpacity | N | N | N | N | Y | N | Y |
| stress | N | N | Y | Y | N | N | N |
| stroke | N | N | N | N | Y | N | Y |
| Dasharray | N | N | N | N | Y | N | Y |
| Dashoffset | N | N | N | N | Y | N | Y |
| Linecap | N | N | N | N | Y | N | Y |
| Linejoin | N | N | N | N | Y | N | Y |
| Miterlimit | N | N | N | N | Y | N | Y |
| Opacity | N | N | N | N | Y | N | Y |
| Width | N | N | N | N | Y | N | Y |
| styleFloat | Y | Y | N | N | N | Y | Y |
| tableLayout | Y | Y | Y | Y | Y | Y | Y |
| textAlign | Y | Y | Y | Y | Y | Y | Y |
| Last | Y | Y | N | N | N | N | N |
| textAutospace | Y | Y | N | N | N | N | N |
| textAnchor | N | N | N | N | Y | N | Y |
| textDecoration | Y | Y | Y | Y | Y | Y | Y |
| Blink (bool) | Y | Y | N | N | N | N | N |
| LineThrough (bool) | Y | Y | N | N | N | N | N |
| None (bool) | Y | Y | N | N | N | N | N |
| Overline (bool) | Y | Y | N | N | N | N | N |
| Underline (bool) | Y | Y | N | N | N | N | N |
| textIndent | Y | Y | Y | Y | Y | Y | Y |
| textJustify | Y | Y | N | N | N | N | N |
| Trim | Y | Y | N | N | N | N | N |
| textKashida | Y | Y | N | N | N | N | N |
| Space | Y | Y | N | N | N | N | N |
| textOverflow | Y | Y | N | N | N | N | N |
| textRendering | N | N | N | N | Y | N | Y |
| textShadow | N | N | Y | Y | Y | Y | Y |
| textTransform | Y | Y | Y | Y | Y | Y | Y |
| textUnderlinePosition | Y | Y | N | N | N | N | N |
| top | Y | Y | Y | Y | Y | Y | Y |
| unicodeBidi | Y | Y | Y | Y | Y | Y | Y |
| vectorEffect | N | N | N | N | N | N | Y |
| verticalAlign | Y | Y | Y | Y | Y | Y | Y |
| viewportFill | N | N | N | N | N | N | Y |
| Opacity | N | N | N | N | N | N | Y |
| visibility | Y | Y | Y | Y | Y | Y | Y |
| voiceFamily | N | N | Y | Y | N | Y | Y |
| volume | N | N | Y | Y | N | Y | Y |
| whiteSpace | Y | Y | Y | Y | Y | Y | Y |
| widows | N | N | Y | Y | Y | Y | Y |
| width | Y | Y | Y | Y | Y | Y | Y |
| wordSpacing | Y | Y | Y | Y | Y | Y | Y |
| wordWrap | Y | Y | N | N | Y | N | N |
| writingMode | Y | Y | N | N | Y | N | Y |
| zIndex | Y | Y | Y | Y | Y | Y | Y |
| zoom | Y | Y | N | N | N | N | N |

### A note on `style.cssText`

The [DOM level2 spec](http://www.w3.org/TR/DOM-Level-2-Style/css.html) defines the `cssText` property as

> The parsable textual representation of the declaration block (excluding the surrounding curly braces). Setting this attribute will result in the parsing of the new value and resetting of all the properties in the declaration block including the removal or addition of properties.

That means you can set all your style attributes in one go by setting `el.style.cssText = myCSSTextString`. Additionally, the correct format for the string is normal CSS syntax, such as what you would assign in a tag's style attribute (`<p style="color: red; padding: 1em 2em; border-bottom: 2px solid #ccc">Hello world</p>`). You can even set properties more than once in the same string, and the browsers will reconcile the duplication as it would when parsing a stylesheet.

There are some caveats with using `cssText` for assignment, however.

-   Opera will throw an error if there is any malformed CSS in the string. (The spec recommends throwing an error if the value assigned has a syntax error and is unparsable. There's a discussion as to what would make a value "unparsable" CSS, but all other browsers silently ignore declarations they don't understand.)
-   Firefox 2 can alter the y value of background-position when reusing the current value of `cssText` in the assignment (such as appending with +=). This is fixed in FF3.

There may be other considerations as well that I haven't yet discovered. On the flip side, benchmarking has shown that assigning a single property via `cssText` is only slightly slower than setting the corresponding property in the style collection, and setting more than one property is significantly faster via `cssText`. Opera 9.27 is the only exception to this, where it was always faster (in my tests, at least) to set the style properties directly.

Have fun getting your style on!