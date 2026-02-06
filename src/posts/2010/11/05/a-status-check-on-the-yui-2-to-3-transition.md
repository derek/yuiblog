---
layout: layouts/post.njk
title: "A Status Check on the YUI 2-to-3 Transition"
author: "Eric Miraglia"
date: 2010-11-05
slug: "a-status-check-on-the-yui-2-to-3-transition"
permalink: /2010/11/05/a-status-check-on-the-yui-2-to-3-transition/
categories:
  - "Development"
---
The [YUI 2 JavaScript and CSS library](http://developer.yahoo.com/yui/ "YUI Library") has been an enormously successful product in the four-plus years since we released it in 2006. YUI 2 distributions have been downloaded more than 2 million times, and thousands of developers today use YUI without ever downloading the files, pulling instead from either the Yahoo! or Google CDN.[1](#configurator) YUI traffic on the Yahoo! CDN has grown steadily over the years since we made it public, and today we estimate that `yui.yahooapis.com` is serving about 15 billion files monthly.

It's no secret, though, that YUI engineers at Yahoo! are spending most of their energy today working on [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library"), the successor project to YUI 2, and one that applies many of the lessons learned by YUI engineers in the years we spent building YUI 2. YUI 3 today is robust and feature-rich. At the utility level (animation, XHR, drag and drop, etc.), it exceeds the functional level of YUI 2. At the widget level, where YUI 2 has been popular with its wide portfolio, YUI 3 is still catching up. YUI 2's DataTable, Editor, Menu, Button and Calendar are still the standard, and YUI 3 users looking for equivalent functionality today are guided to the [YUI 2-in-3 project](/yuiblog/blog/2010/03/11/yui-2-in-3-coming-soon/ "YUI 2 in 3: Coming in YUI 3.1.0, a Simpler Way To Use YUI 2 Modules » Yahoo! User Interface Blog (YUIBlog)"), which allows you to easily include and utilize YUI 2 from within YUI 3 implementations. This is easy and safe, but it's also not optimal: We'd prefer not to switch between the two APIs, and we'd prefer not to incur the runtime overhead of loading two library cores.

As we prepare for next week's [YUIConf 2010](http://yuilibrary.com/yuiconf2010/), it seemed like a good time to review the status of the YUI 2-to-YUI 3 transition. We're a little over a year into the YUI 3 era, and not quite a year out from the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery")'s launch. Between the YUI team at Yahoo! and those of you in the YUI community contributing components (nearly 100 contribitors in total), how are we doing?

The answer may surprise you.

With projects like [LifeRay's AlloyUI](http://alloy.liferay.com/ "Alloy UI - A project of Liferay") and dozens of independent contributors populating the Gallery, we now have more options available even at the widget level in YUI 3 than we shipped with YUI 2. The table below matches functionality between the two libraries and gives a sense of how the two libraries compare in terms of functional categories. Caveats:

-   **Few rows are 1:1 comparisons**. When I say that functionality is supported, I don't mean that it is supported in exactly the same way or at the same feature level in both codelines.
-   **All unsupported features in YUI 3 can be accessed via YUI 2-in-3**.
-   Where I've indicated that something is supported via community/Gallery, I'm not suggesting anything about the feature completeness of the Gallery content -- merely that the community has responded to that need and produced and shared a solution.
-   **This table includes only a fraction of the content that is in Gallery.** A truer picture, including all Gallery content, would show YUI 3 dwarfing YUI 2 in terms of component options. I've confined myself here to the baseline functionality of YUI 2, its equivalent in YUI 3, and major new developments in the YUI 3 world (including major component categories that have emerged in Gallery).

| Core Components |
| --- |
| Component | YUI 2 | YUI 3 | Notes |
| Library Core | Yahoo Global Object | YUI module | Some of the YUI 2 functionality has moved to other modules — oop and lang. |
| Loader | YUI Loader | Loader module | YUI 3's Loader is intrinsic (will be invoked automatically) and includes support for Gallery. |
| DOM support | DOM Collection | Node module | YUI 3 is "node-centric" — working via the Node API is a paradigm shift between YUI 2 and 3. |
| Browser and Custom Events | Event Utility | Event module |  |
| Component Foundation |
| Component | YUI 2 | YUI 3 | Notes |
| Attribute management | AttributeProvider | Attribute module |  |
| Event management | EventProvider | EventTarget in the Custom Event module |  |
| Component base |  | Base module |  |
| Extension model |  | Base module |  |
| Plugin model |  | Plugin and Plugin Host modules |  |
| Widget foundation | Element Utility | Widget module | YUI 2's Element Utility lacks the lifecycle pattern for component development contained in the YUI 3 Base/Widget system. |
| Utilities |
| Component | YUI 2 | YUI 3 | Notes |
| Ajax/XHR | Connection Manager Utility | IO module |  |
| Animation | Animation Utility | 
-   Animation module
-   Transition module

 | YUI 3 adds support for CSS transitions via the Transitions module, supporting hardware-accelerated transitions where supported. |
| Asset Prefetching |  | [Caridy Patiño Mayea's Preload module](http://yuilibrary.com/gallery/show/preload "YUI Library :: Gallery :: Preload") |  |
| Asynchronous Queueing |  | AsyncQueue module | Support for a chain of function callbacks executed via `setTimeout`. YUI 2's delivery of this functionality is not split out sufficiently for general use. |
| Authentication |  | [Dav Glass's oAuth module](http://yuilibrary.com/gallery/show/oauth "YUI Library :: Gallery :: oAuth") |  |
| Cache |  | Cache module | Support for storing key/value pairs in local JS memory. |
| Cookie | Cookie Utility | Cookie module |  |
| Data Management | DataSource Utility | 

-   DataSchema (beta)
-   DataSource (beta)
-   DataType (beta)

 | There is not exact feature parity between the two (for example, queueing is not supported in YUI 3; YUI 3 modules remain in beta.) |
| Drag and Drop | Drag and Drop Utility | DD module |  |
| Event Extras | 

-   Event delegation
-   Event simulation

 | 

-   Event delegation
-   Event simulation
-   Gestures
-   Synthetic events
-   Touch events

 | YUI 3's event support exceeds the YUI 2 branch, with a good abstractions for touch and gestures. |
| Form Validation | [InputEx Field/Form Framework](http://neyric.github.com/inputex/ "inputEx - a field framework for web applications") | The YUI 3 Gallery has too many form-related modules to list here — one group is from the prolific developers of AlloyUI, and there are many more from other contributors. |  |
| Geolocation |  | [Mikael Abrahamsson's Geolocation module](http://yuilibrary.com/gallery/show/geolocation) |  |
| Get (script/CSS loading) | Get Utility | Get module |  |
| History management | History Utility | History module | YUI 3's History module includes HTML5 support. |
| ImageLoader (smart deferral of image load) | ImageLoader Utility | ImageLoader module |  |
| Internationalization | varies by component | Internationalization module | YUI 3's i18n model is more robust, but there is work to do to realize all of its benefits throughout the widget system. |
| JSON | JSON Utility | JSON module | YUI 3 includes the JSONP module which provides a facility for working with JSONP callbacks from within YUI 3's sandbox patterns. |
| Resize | Resize Utility | [AlloyUI Resize](http://yuilibrary.com/gallery/show/aui-resize "YUI Library :: Gallery :: AlloyUI Resize") | The AlloyUI implementation in Gallery has been adopted into the library core and will be part of the 3.3.0 release. |
| Storage (client-side) | Storage Utility (includes Flash fallback) | [Storage Lite](http://yuilibrary.com/gallery/show/storage-lite "YUI Library :: Gallery :: Storage Lite") | Storage Lite does not support a Flash fallback. |
| Stylesheet (manipulation via JS) | Stylesheet Utility | Stylesheet module |  |
| SWF management | SWF Utility | 

-   SWF module
-   [AlloyUI SWF (Gallery)](http://yuilibrary.com/gallery/show/aui-swf "YUI Library :: Gallery :: AlloyUI SWF")

 |  |
| SVG Support |  | 

-   [Vincent Hardy's YUI SVG Extensions module](http://yuilibrary.com/gallery/show/svg "YUI Library :: Gallery :: YUI SVG Extensions")
-   [Matthew Taylor's Raphael module](http://yuilibrary.com/gallery/show/raphael "YUI Library :: Gallery :: Raphael")

 |  |
| Undo/Redo Support |  | [Iliyan Peychev's Undo/Redo Framework module](http://yuilibrary.com/gallery/show/undo "YUI Library :: Gallery :: Undo/Redo Framework") |  |
| YQL wrapper |  | YQL Query module |  |
| UI Widgets |
| Component | YUI 2 | YUI 3 | Notes |
| Accordion | 

-   [Marco van Hylckama Vlieg's AccordionView](/yuiblog/blog/2008/07/25/accordionview/)
-   [Caridy Patiño Mayea's Accordion Manager](http://www.bubbling-library.com/eng/api/docs/widgets/accordion/examples)

 | 

-   [Iliyan Peychev's Accordion](http://yuilibrary.com/gallery/show/accordion)
-   [John Lindal's Accordion (Horizontal/Vertical)](http://yuilibrary.com/gallery/show/accordion-horiz-vert)
-   [Caridy Patiño Mayea's Node Accordion](http://yuilibrary.com/gallery/show/node-accordion)

 | As a YUI 2-based widget, Marco's component is not in the YUI 3 Gallery formally. |
| AutoComplete | AutoComplete Control | 

-   [AlloyUI AutoComplete](http://yuilibrary.com/gallery/show/aui-autocomplete "YUI Library :: Gallery :: AlloyUI Autocomplete")
-   [Autocomplete v2](http://yuilibrary.com/gallery/show/ac-widget-v2)

 | YUI 3 AutoComplete will ship with YUI 3.3.0. Don't overlook the AlloyUI component here, though — it is feature rich and ready to use today. |
| Button | Button Control | [Anthony Pipkin's Button module](http://yuilibrary.com/gallery/show/button) |  |
| Calendar | Calendar Control | [AlloyUI Calendar](http://yuilibrary.com/gallery/show/aui-calendar) | Calendar widget/date selection is not expected as part of the YUI 3 distribution until 3.4.0 or later; the AlloyUI implementation, however, is an excellent choice for the common use cases. |
| Carousel | Carousel Control | [Gopal Venkatesan's Carousel module](http://yuilibrary.com/gallery/show/carousel) | Gopal has owned the YUI 2.x Carousel codebase for a long time, and his YUI 3 Gallery module will be in production Yahoo! products this year. |
| Charts | Charts Control | 

-   [AlloyUI Chart module (Gallery; uses YUI 3 Charts under the hood)](http://alloy.liferay.com/demos.php?demo=charts "Alloy UI - A project of Liferay")
-   [Tripp Bridges's Charts module](http://yuilibrary.com/gallery/show/charts)

 | Tripp is one of the authors and the maintainer of the YUI 2 Charts Control, which is Flash-based. The YUI 3 Charts work, which does not rely on Flash, is being pushed to Gallery on a regular basis and Tripp's work to-date will ship in beta as part of YUI 3.3.0. |
| Color Picker | Color Picker Control | [AlloyUI Color Picker](http://yuilibrary.com/gallery/show/aui-color-picker) |  |
| DataTable | DataTable Control | [Anthony Pipkin's Simple Datatable module](http://yuilibrary.com/gallery/show/simple-datatable) | Anthony's project, which includes a few plugin modules, is not meant to have feature parity with the ambitious YUI 2 DataTable Control. The work being done by the YUI team on YUI 3 DataTable will appear in beta form in 3.3.0. |
| Image Cropping | ImageCropper Control |  |  |
| Layout (full screen application management) | Layout Manager |  |  |
| Menuing | Menu Control | 

-   [Julien Lecomte's Simple Menu module](http://yuilibrary.com/gallery/show/simple-menu "YUI Library :: Gallery :: Simple Menu")
-   Node MenuNav (beta)

 | Simple Menu is not as feature rich as the comprehensive menuing support provided in YUI 2. At present, the YUI team plans work on a YUI 3 menu control for the 3.4.0 timeframe. Node MenuNav is part of the YUI 3 distribution, but it remains in beta and may be deprecated in favor of new work on a formal UI control. |
| Overlays | Container Family | 

-   Overlay module
-   [Anthony Pipkin's Dialog module (Gallery)](http://yuilibrary.com/gallery/show/dialog)
-   [AlloyUI Dialog module (Gallery)](http://yuilibrary.com/gallery/show/aui-dialog "YUI Library :: Gallery :: AlloyUI Dialog")
-   [AlloyUI Overlay module (Gallery)](http://yuilibrary.com/gallery/show/aui-overlay)
-   [Eric Ferraiuolo's Overlay Extras module (Gallery)](http://yuilibrary.com/gallery/show/overlay-extras)
-   [Patrick Cavit's Overlay Transitions module (Gallery)](http://yuilibrary.com/gallery/show/overlay-transition)

 |  |
| Pagination | Paginator Control | [John Lindal's Paginator Port module](http://yuilibrary.com/gallery/show/paginator "YUI Library :: Gallery :: Paginator Port") |  |
| Progress Bar | ProgressBar Control | 

-   [Anthony Pipkin's Progress Bar module](http://yuilibrary.com/gallery/show/progress-bar)
-   [Satyam's YUI 3 Progress Bar implementation](http://satyam.com.ar/yui/3.0.0/progressbar/ "Progress Bar")

 | Satyam wrote the YUI 2 ProgressBar Control; his YUI 3 implementation is not in the Gallery, but it is available for use. |
| Ratings |  | 

-   [AlloyUI Rating module](http://yuilibrary.com/gallery/show/aui-rating "YUI Library :: Gallery :: AlloyUI Rating")
-   [Peter Peterson's Ratings module](http://yuilibrary.com/gallery/show/ratings "YUI Library :: Gallery :: Ratings")

 |  |
| Rich Text Editing | Rich Text Editor | [Simple Editor Port](http://yuilibrary.com/gallery/show/simple-editor "YUI Library :: Gallery :: Simple Editor Port") | YUI 3.3.0 will contain the base Editor content that Yahoo! is using in the new Yahoo! Mail beta — which is the most advanced Editor we've produced as part of YUI. However, the Editor toolbar (which is an important part of the component for most implementers) will rely on Button and Menuing functionality that won't appear until at least 3.4.0. |
| ScrollView |  | ScrollView module | This is an important component for mobile development. |
| Slideshows |  | 

-   [AlloyUI Image Viewer module](http://yuilibrary.com/gallery/show/aui-image-viewer "YUI Library :: Gallery :: AlloyUI Image Viewer")
-   [Andrew Bialecki's Lightbox module](http://yuilibrary.com/gallery/show/lightbox "YUI Library :: Gallery :: Lightbox")
-   [Jeff Craig's Slideshow module](http://yuilibrary.com/gallery/show/slideshow "YUI Library :: Gallery :: Slideshow")
-   [Josh Lizarraga's YUI Slideshow module](http://yuilibrary.com/gallery/show/yui-slideshow "YUI Library :: Gallery :: YUI Slideshow")

 | This category is a good example of what the YUI Gallery can become. Whereas we never had a strong YUI 3 slideshow component, we already have four excellent modules to choose from in the YUI 3 world. |
| Sliders | Slider Control | 

-   Slider module
-   [Adam Moore's simpleslider module (Gallery)](http://yuilibrary.com/gallery/show/simpleslider "YUI Library :: Gallery :: simpleslider")

 | YUI 3.3.0 will contain an interesting new addition to the slider interaction pattern, courtesy of Yahoo! designer and engineer Jeff Conniff. Stay tuned for more on this as 3.3.0 preview releases appear. |
| Tabs | TabView Control | TabView module |  |
| Trees | TreeView Control | 

-   [AlloyUI Tree](http://yuilibrary.com/gallery/show/aui-tree "YUI Library :: Gallery :: AlloyUI Tree")
-   [Matt Parker's TreeviewLite module](http://yuilibrary.com/gallery/show/treeviewlite "YUI Library :: Gallery :: TreeviewLite")
-   [Adam Moore's YUI 2 treeview port module](http://yuilibrary.com/gallery/show/treeview "YUI Library :: Gallery :: YUI 2 treeview port")

 | Yahoo! engineer Gonzalo Cordero is currently working on a YUI 3 TreeView implementation. While it will not be ready for 3.3.0, it is expected to be available in the Gallery after the 3.3.0 release and be a candidate for the distribution as early as 3.4.0. |
| Uploader (multi-file uploading with progress tracking) | Uploader Control | Uploader module | Both YUI 2 and YUI 3 implementations require Flash. |
| Video (HTML5) |  | 

-   [Josh Brickner's HTML5 Player module](http://yuilibrary.com/gallery/show/player "YUI Library :: Gallery :: HTML5 Player")
-   [Greg Hinch's Video module](http://yuilibrary.com/gallery/show/video "YUI Library :: Gallery :: Video")

 |  |
| CSS Components |
| Component | YUI 2 | YUI 3 | Notes |
| Reset | CSS Reset | CSS Reset |  |
| Base | CSS Base | CSS Base |  |
| Fonts | CSS Fonts | CSS Fonts |  |
| Grids | CSS Grids | CSS Grids | The new, more flexible YUI 3 CSS Grids package was released in 3.2.0. |

### Notes:

1.  The [YUI 2 Dependency Configurator](http://developer.yahoo.com/yui/articles/hosting/ "YUI 2: Dependency Configurator") can help you design your script and css includes for either Yahoo! or Google CDNs.