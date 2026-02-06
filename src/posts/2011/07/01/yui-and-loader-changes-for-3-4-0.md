---
layout: layouts/post.njk
title: "YUI and Loader changes for 3.4.0"
author: "Dav Glass"
date: 2011-07-01
slug: "yui-and-loader-changes-for-3-4-0"
permalink: /2011/07/01/yui-and-loader-changes-for-3-4-0/
categories:
  - "Development"
---
In 3.4.0 we started the process of shifting some of Loader's logic around, to not only make it more performant, but to make it more robust and easier to use in other places (like on the server). We will be rolling out more changes in future revisions, but I wanted to take some time and explain what was changed, why it was changed and how it may impact developers. For the majority of use-cases, developers will notice nothing different, except that things are a little faster and their requirement downloads are a little smaller.

### Seed File

The first thing I want to address is the YUI seed file. In previous versions of YUI, our seed file was very tiny and did not contain Loader or any of its meta-data. We've found that in the 90% use-case this was not as performant as we had hoped. The normal user includes the seed file then requests their modules, which in turn means that the seed needs to first fetch Loader, then calculate all of its dependencies, then fetch them all. We now feel that this extra http request is the wrong thing to do, so the new standard seed file contains Loader and its meta-data. Yes, this will make the initial request a little larger, but it will make the loading of modules that much faster since all of its meta-data requirements are now already on the page.

If you wish to use it the old way, you can just include the yui-base seed file instead. It contains everything that is needed to make YUI run in stand-alone mode plus it contains the ability to fetch Loader on demand. If you require even finer-grained dependencies, we have created a yui-core seed file that is exactly what the old yui-base seed was.

```
    /build/yui/yui-min.js //YUI Seed + Loader
    /build/yui-base/yui-base-min.js //Old YUI Seed with Loader fetch support
    /build/yui-core/yui-core-min.js //Old yui-base without Loader fetch support

```

It should be noted that these URLs are different than the previous URLs. Anyone that was using the `yui/yui-base.js` files need to repoint them to `yui-core/yui-core.js`. If you want the older way of loading the seed and fetching Loader, you would use the `yui-base/yui-base.js` seed file.

The other reasoning for this change is our roadmap for making YUI run in as many places as possible. The old seed file plus Loader in a single combo server request is all well and good if you have a combo server available in your application. _But what about on the server? Or in an offline app on a mobile device?_ These places need to minimize file access while still getting the information they need.

### Rollups

The next thing that we changed was removing rollups from the system and defaulting **allowRollup** to false in the Loader config. _What does this mean to you?_ Well, hopefully nothing at all. Before I explain the impact of the change, let me explain the reasoning behind it. The primary reason is, again, performance, along with payload delivery. Take this example:

```
     Module A: requires event-a, event-b
     Module B: requires event-c, event-d

```

When you request both, the rollup logic prior to 3.4.0 used to determine that you should get the _event_ rollup. Which actually meant that you were getting:

```
     event.a, event.b, event.c, event.d, event.e, event.f, event.g, event.h

```

You ended up with more on your page than you actually needed. By turning off the rollup support, YUI will now ask for only what you actually requested and nothing more. In most cases, you _will not notice this_. Module developers, may run into a situation where things that worked in the past may not work now. The reason for this is that they actually worked by _accident_ before. Let me use a real world example: **Dial**.

In 3.3.0, Dial required this:

```
    requires: [
        'widget',
        'dd-drag',
        'substitute',
        'event-mouseenter', 
        'transition',
        'intl'
    ]

```

For the most part, Dial worked in 3.4.0, however keyboard support did not work. After doing some simple investigating, it turned out that the rollup support was actually requesting the entire **Event** rollup (which includes event-move and event-key). Without the rollup logic pulling in all of event, 3.4.0 Dial no longer had all of its requirements. Making Dial's requirements more specific and defining all of its actual dependencies properly makes it work as expected.

```
    requires: [
        'widget',
        'dd-drag',
        'substitute',
        'event-mouseenter',
        'event-move',
        'event-key',
        'transition',
        'intl'
    ]

```

For module developers, it is a best practice to make sure that your module requires exactly what it needs to function. Do not **assume** that an upstream module requirement is there. It's always better to make sure that you ask for what you need.

This also means that module requirements are more well defined. For example, `datatype-date` has Intl support built in. In previous versions you would access the Intl like this:

```
    Y.Intl.getAvailableLangs('datatype-date');

```

But since this module doesn't actually have a language (the `datatype-date-format` module does), this will fail. It needs to be more specific and actually ask for languages for the correct module:

```
    Y.Intl.getAvailableLangs('datatype-date-format');

```

### Build File Explosion and Submodule Removal

After making this change, the next change we made was exploding the build directory and removing submodules from the core system. Submodule logic was not removed, only our meta-data structure was changed. This will provide backward compatibility for current installations.

Submodules in the core system caused a couple of issues that we needed to resolve. The first reason was performance. Each time Loader needed to calculate dependencies, it needed to walk the submodule/plugin structure of each module. Doing this thousands of times was hurting our performance during the Loader calculate routine. By removing support for submodules in the core system we saved tens of thousands of function calls and iterations.

Loader was changed so that if a `use` property in a module's meta-data defined more modules, it will use those modules instead of trying to load the original module. So, if you requested "`dd`" Loader would inspect "`dd`"'s meta-data and see a use property that looks something like this:

```
    "dd-ddm-base,dd-ddm,dd-ddm-drop,dd-drag,dd-proxy,dd-constrain,dd-drop,dd-scroll,dd-drop-plugin"

```

In the core YUI seed file, we are also including what we are calling **virtual rollups** or **aliases**. These module definitions are exactly the same as the meta-data in Loader. This way you can include all the files exported from our _Dependency Configurator_ and still use these rollups without having Loader present on the page. In future releases, we will be refining this approach even more.

After making this change, we then preceeded to explode our build files. In previous releases, the submodules determined the modules file path. For example:

```
    "dd": {
        "submodules": {
            "dd-drag": 
            // Module data
        }
    }

```

In 3.3.0 when you built "dd", the file structure looked something like this:

```
    /build/dd/dd-drag.js
    /build/dd/dd-ddm.js
    /build/dd/dd-drop.js

```

With the build system exploded in 3.4.0, "dd"'s build files now look like this:

```
    /build/dd-drag/dd-drag.js
    /build/dd-ddm/dd-ddm.js
    /build/dd-drop/dd-drop.js

```

This allowed us to remove the "path" property from all of our module meta-data as well, saving file size and reducing the logic required to assemble the modules url paths.

**If you are including a pre-configured combo URL, you must recalculate your URL when you upgrade.**

The downside to this change is that if you are including a combo URL of modules to "prep" your page you can not just change the version number and upgrade. You will need to revisit the **Dependency Configurator** and generate a new URL with new module structure.

### The Future

I will be continuing to refine, refactor and maximize every aspect of our Loader and Seed strategy. These first steps were needed to aid in future changes that need to be made for not only our client-side strategy but also our server, command-line and mobile device strategies as well.