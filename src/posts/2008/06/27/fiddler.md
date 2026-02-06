---
layout: layouts/post.njk
title: "Production JavaScript Debugging"
author: "Unknown"
date: 2008-06-27
slug: "fiddler"
permalink: /blog/2008/06/27/fiddler/
categories:
  - "Development"
---
You know the scenario. A bug is filed for a JavaScript issue in production. You update your development server to the same files (allegedly) that are in production but you can't reproduce the issue. Debugging your JavaScript code is horrifically difficult, if not impossible, because you're following best practices and crunching the file using the YUI Compressor.

You start by typing the URL of the JavaScript into a browser to confirm that the file is there. It is, and in fact, is being loaded into the browser without issue. So something must have gone wrong during the deployment process, but you need to know what part of the code is failing. [Firebug](http://www.getfirebug.com/), your trusty companion for JavaScript debugging, is essentially useless as it has a hard time deciphering all of your code from a single line.

When I end up in this situation, I turn to a little-known but incredibly powerful tool from Microsoft called [Fiddler](http://www.fiddlertool.com/). Fiddler is an HTTP debugging proxy that filters all the requests coming to your machine via HTTP. It interfaces directly with WinINET, the Microsoft Internet communications stack, so it automatically picks up any requests and responses by programs using this library. By simply starting Fiddler, it will automatically pick up HTTP traffic for Internet Explorer, Safari, and Opera. Firefox doesn't use WinINET, so you need to manually set it up to go through Fiddler. You can do so by going to the Tools menu and clicking on Options. Go to the Network tab and click the Settings button. Select Manual Proxy Configuration and enter localhost as your server and 8888 as your port. Click OK to apply the settings.

![Setting up Firefox's options in preparation for using Fiddler.](/yuiblog/blog-archive/assets/firefox_options.png)

Once that's done, you're ready to start debugging that production JavaScript. The key to debugging is really to create a readable version of the JavaScript so that Firebug (or any other JavaScript debugger) can be used to step through the code and set breakpoints as normal. To do so, download the file in production to your local machine. Use a pretty printing tool, such as Einars "elfz" Lielmanis' [online beautifier](http://elfz.laacz.lv/beautify/) to create a more readable version of your code and save it to a local file. It's important to follow this process instead of using your development version of the JavaScript to ensure that you're using the exact same code that is on production; you can more easily rule out deployment issues this way.

![The Fiddler Autoresponder tab.](/yuiblog/blog-archive/assets/fiddler_autoresponder.png)

Next, click on Fiddler's AutoResponder tab. The settings on this tab allow you to intercept requests and respond as if you were the server. It's possible to respond with a status code or with actual content. To enable this feature, check the **Enable automatic responses** checkbox. The **Permit passthrough for unmatched requests checkbox** should be checked by default, which is necessary to avoid interfering with other requests. Click the Add button to create a new entry. The textbox on the left should contain either the complete URI for the JavaScript file you want to intercept, or you can create a regular expression by preceding your text with "regex". The second textbox is for the response that should be sent. Click the dropdown arrow and select **Find a file**. Select the pretty-printed JavaScript file from your computer and click the **Save** button. This places your filter in Fiddler's memory so the next time a file matching the given URI or description is requested, it will respond by sending back the file on your computer.

After that, you can navigate back to the production server on which the problem exists knowing that your file will be inserted in place of the actual production file. The browser itself is none the wiser that the file has been swapped out, so you're safely able to debug readable code without making any changes to the code on the server. This technique has helped me debug some of the more complex issues I've dealt with at Yahoo!, and I hope that it can help you as well.