---
layout: layouts/post.njk
title: "Building a Fast People-Finder for Flickr with YUI AutoComplete"
author: "Ross Harmes"
date: 2009-03-26
slug: "flickr-autocomplete"
permalink: /2009/03/26/flickr-autocomplete/
categories:
  - "Development"
---
At [Flickr](http://flickr.com/), we recently added a new people-selector widget to a few of our pages; this feature is based on the [YUI AutoComplete Control](http://developer.yahoo.com/yui/autocomplete/). The people-selector widget allows our members to select individuals from their contact list, which can contain upwards of 20,000 entries. Due to the large amount of data involved, traditional techniques for fetching and parsing the data were not feasible, mostly due to extremely slow parse times. In this post, we'll take a look at some of the different data formats we tried and at the AutoComplete configuration we found to be most performant.

First, here's a video recap of what we were trying to accomplish; the new interaction with the people-finder widget is depicted on the right:

   

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="http://www.flickr.com/apps/video/stewart.swf?v=68975" height="229" type="application/x-shockwave-flash" width="400"><param name="flashvars" value="intl_lang=en-us&amp;photo_secret=7d60e13b0d&amp;photo_id=3328806159"> <param name="movie" value="http://www.flickr.com/apps/video/stewart.swf?v=68975"> <param name="bgcolor" value="#000000"> <param name="allowFullScreen" value="true"><embed allowfullscreen="true" bgcolor="#000000" flashvars="intl_lang=en-us&amp;photo_secret=7d60e13b0d&amp;photo_id=3328806159" height="229" src="http://www.flickr.com/apps/video/stewart.swf?v=68975" type="application/x-shockwave-flash" width="400"></object>

## Fetching and Parsing: XHR and Custom Data

The biggest challenge was finding a data format that would be fast to download, fast to parse, and — above all else — secure. We first tried XML and Ajax, but XML parsing proved to be much to slow — in fact, we found that this approach could bring down the browser on larger data sets. Next we tried a combination of JSON and Ajax; this was significantly faster, but it still took more than 80 seconds to parse our largest data set (an array containing roughly 10,700 objects, each with several properties).

In the end, we found two transport/parse techniques that turned out to be extremely fast:

1.  Fetching JSON (wrapped in a callback function) using dynamically generated script tags;
2.  parsing a custom data format (a control-character delimited list) using `split()`, fetched with Ajax (using [YUI Connection Manager](http://developer.yahoo.com/yui/connection/)).

In the end, we went with the custom format. Formatting our JSON so that it could be executed by a dynamic script tag was a less secure approach and not a performance win. Using XHR gave us a more secure and still very performant solution.

## User Interaction: YUI AutoComplete

Once we had a way to get the data into JavaScript quickly, the next challenge was to create a way for the user to quickly search through the list of contacts. To accomplish this, we turned to YUI's AutoComplete Control. It met our needs exactly: _extremely_ fast and very configurable. To use it with our custom data, we created a function to use as the AutoComplete instance's DataSource; every keypress in the widget triggers this function and passes in the search string. Within this function, we loop through all of the member's contacts and try to match the query on four different fields. We used regular expressions to do the string matching.

Even for large sets of contacts, we found this technique to be extremely efficient. Here is the basic version of what we did:

```
function searchContacts(query) {

       var matches = [],
           queryRegEx = new RegExp(query, 'i'), // query should be
                                                // checked before 
                                                // using in a regex.
           contact;

        for (var n = 0, len = contacts.length; n < len; n++) {

               contact = contacts[n];

               if (contact.username.search(queryRegEx) !== -1 ||
                   contact.realname.search(queryRegEx) !== -1 ||
                   contact.emailAddress.search(queryRegEx) !== -1 ||
                   contact.alias.search(queryRegEx) !== -1) {
                       matches.push(contact);
               }
       }

       return matches;
}
```

Once we had the data connected to the widget, we made one change to the default AutoComplete configuration: We set the `queryDelay` parameter to `0` (the default value is 200ms). This means that there will be no delay between a key press and a search being initiated. There are downsides to this (the AutoComplete display tends to flicker a bit if you type a few characters in quick succession), but we found it to be the single biggest improvement we made, more important even than optimizations to our search function. While a `queryDelay` of 200ms or more might be more appropriate for XHR or other remote DataSources, we found that our regex-based DataSource with local data was up to the task of searching on every keystroke. With AutoComplete, we got free caching added to the mix so that any given search would only have to be done once.

More details on all of these techniques, including full details on the different data formats and extensive profiling data for each one, can be found on the [code.flickr](http://code.flickr.com/blog/2009/03/18/building-fast-client-side-searches/) blog.