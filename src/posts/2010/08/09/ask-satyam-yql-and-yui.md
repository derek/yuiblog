---
layout: layouts/post.njk
title: "Ask Satyam: Using YQL and YUI with YQLDataSource"
author: "Satyam"
date: 2010-08-09
slug: "ask-satyam-yql-and-yui"
permalink: /blog/2010/08/09/ask-satyam-yql-and-yui/
categories:
  - "Development"
---
> [![](/yuiblog/blog-archive/assets/satyam-book-small-20100809-120823.jpg)](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book)Satyam (a.k.a Daniel Barreiro) is a long-time YUI contributor and one of the most prolific, generous experts in the [YUI forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page"). He is also [the author of a new book on YUI 2.8.0, _YUI 2.8.0: Learning the Library_](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book). This article in the "Ask Satyam" series [was suggested by Mike Hatfield](/yuiblog/blog/2010/07/29/ask-satyam/#comment-593067 "Ask Satyam — and Be Eligible for a Free Copy of the New YUI 2.8 Book from Packt » Yahoo! User Interface Blog (YUIBlog)"). Satyam will be answering several additional questions in the coming weeks here on YUIBlog as part of the series.

### Getting to Know YQL

Yahoo! Query Language, [YQL](http://developer.yahoo.com/yql/), is a great way of accessing an immense amount of information via a standard easy-to-use interface. To have a taste of how easy it is, compare the old [Artist Service documentation](http://developer.yahoo.com/music/api_guide/ArtistService.html) with this simple YQL query: `[select * from music.artist.search where keyword='Rihanna'.](http://developer.yahoo.com/yql/console/?q=select%20*%20from%20music.artist.search%20where%20keyword='Rihanna'&_uiFocus=music)`

[![](/yuiblog/blog-archive/assets/yql-20100809-102848.jpg)](http://developer.yahoo.com/yql/console/?q=select%20*%20from%20music.artist.search%20where%20keyword='Rihanna'&_uiFocus=music)

The [YQL Console](http://developer.yahoo.com/yql/console/) is very easy to use. It lists many of the tables available and sample queries on them so you can easily explore the wealth of information accessible through it. YQL does not store the data; rather, it is a query interface to other databases or APIs. The number of tables that YQL lists from Yahoo! sources is 142 but if you click on the [Show Community Tables](http://developer.yahoo.com/yql/console/?q=show%20tables&env=store://datatables.org/alltableswithkeys) link, the count rises to 825 and includes access to public data on Amazon, Facebook, NetFlix or the New York Times. (That's where you'll find a few YUI-related tables, too.)

Sometimes these tables require an access key you have to obtain from their owners; without it you may either not be able to perform the query or you will get a limited number of results. The YQL service itself has two addresses, one public and another which requires registration and provides better performance and, of course, you will need authentication to access private data from some of its tables.

By default, YQL will only provide a sample reply with about 10 records. You can specify a larger number of results by adding the requested number of results in parentheses after the table name, for example:

```
select * from music.artist.search(22) where keyword="madonna"
```

Next to each table name in the Data Tables list in the YQL Console, whenever you mouse over a table name a  Desc  button will show to the right of the table name. That will provide a description of the table and will usually include sample queries and a list of fields. Be attentive to which fields are marked as _required_. This is where you may find required access keys for certain tables.

### Using YQL with YUI

YQL is a flexible, generic interface to structured data on the web, and YUI (with [DataSource](http://developer.yahoo.com/yui/datasource/ "YUI 2: DataSource"), [AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete"), [DataTable](http://developer.yahoo.com/yui/datatable/ "YUI 2: DataTable") and [Charts](http://developer.yahoo.com/yui/charts/ "YUI 2: Charts")) is good at consuming and providing interfaces to this data.

There are a few caveats to keep in mind at the outset, however.

### Quirk #1: Partial Queries and YQL Source Data

Some tables are not fit for pairing with [AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete") since they don't provide results for partial search keys. Although YQL allows wildcard queries such as `keyword like 'mado%'`, the actual provider of the data may not support such queries — so as the user starts typing in the AutoComplete box the name of Madonna, only results with full-word matches will appear and Madonna will not be offered until the name is typed in full. Keep this in mind as you explore the YQL Tables that are of interest to you in your application.

### Quirk #2: Sorting and Pagination in YQL

Sorting in YQL is a filter applied after the result set is fetched. If you were to use YQL as the source for a DataTable with server-side sorting and pagination, you would be in trouble: If the user has the table already sorted by a certain column and asks for page two, YQL will first select the next _N_ records of the unsorted table and then sort those when you would normally expect the next _N_ records of the sorted table. For example, say you have a table with a single numeric field and the table contains 4,3,2,1 in that order. You have a DataTable with two rows per page and have it sorted by its single column. YQL will return 3,4 for the first page and 1,2 for the second, instead of 1,2 and then 3,4. That is because it first does the 'page' selection on the unsorted data and then sorts it.

### Quirk #3: YQl Response Structures

YQL response structures change depending on the number of items returned. If we were to dump the variable pointing to the results, we may get any of these, depending on the item count: #yqldatasource td {border:1px solid black; padding:5px;} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

| Count | YQL Response | Consistent Version |
| --- | --- | --- |
| 0 | 
```
Null
```
 | 
```
[]
```
 |
| 1 | 
```
{someChangingPropertyName: {
			fieldName1:value1, 
			fieldName2:value2, 
			...
		}}
```
 | 
```
[
			{
				fieldName1:value1, 
				fieldName2:value2, 
			...
			}
		]
```
 |
| 2 or more | 
```
{someChangingPropertyName: [
		    {
				fieldName1:value1row1, 
				fieldName2:value2row1,
				...
			},
		    {
				fieldName1:value1row2, 
				fieldName2:value2row2, 
				...
			},
		    ...
		]}
```
 | 
```
[
		    {
				fieldName1:value1row1, 
				fieldName2:value2row1, 
				...
			},
		    {
				fieldName1:value1row2, 
				fieldName2:value2row2, 
				...
			},
		    ...
		]
```
 |

The last column shows a more consistent alternative, no whimsical property name and always an array with whatever number of items the query might return, but always a simple array.

### YQL and Asynchronous Cross-Domain Data

YQL can also provide the very same information in several formats, [XML](http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.places%20where%20text=%22san%20francisco,%20ca%22), [JSON](http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.places%20where%20text=%22san%20francisco,%20ca%22&format=json) and [JSONP](http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.places%20where%20text=%22san%20francisco,%20ca%22&format=json&callback=cbfunc), the later being the one we are most interested in. Due to the [Same-Origin Policy](http://en.wikipedia.org/wiki/Same_origin_policy), browsers don't allow their [XMLHttpRequest](http://en.wikipedia.org/wiki/XMLHttpRequest) object to access sources out of its own domain. [YUI's Connection Manager](http://developer.yahoo.com/yui/connection/) and [YUI IO](http://developer.yahoo.com/yui/3/io/ "YUI 3: IO"), which were originally limited to XMLHttpRequest, have introduced an [XDR interface with Flash](http://developer.yahoo.com/yui/connection/#xdr) which allows such cross-domain requests.

The [YUI Get Utility](http://developer.yahoo.com/yui/get/) coupled with YQL's [JSONP](http://en.wikipedia.org/wiki/JSONP#JSONP) capability also addresses this problem. Let's see how this works. You can add `<script>` tags at any time and `<script>` tags can load anything from anywhere; we do this regularly when we load the YUI Library components from Yahoo!'s CDN regardless of where our page is located. However, this approach requires some help from the server because the `<script>` tag expects JavaScript code. If we were to load a file containing the following:

```
123
```

it wouldn't do us any good, because the value is not assigned to a variable. If we were to load this:

```
var result = 123;
```

then, the number would be stored into variable `result`. Such a variable would be in the global scope, [which is not a good idea](/yuiblog/blog/2006/06/01/global-domination/ "Global Domination » Yahoo! User Interface Blog (YUIBlog)"). Even worse, although value would be retrievable once stored, we wouldn't know when it becomes available; we'd have to poll the `result` variable to discover when we'd gotten data. The [YUI Get Utility](http://developer.yahoo.com/yui/get/ "YUI 2: Get Utility") solves this problem by signaling both successful and failed transactions.

A more general solution, relying on some help from the server, is to wrap the value in a callback function:

```
callbackFunction(123);
```

This function takes care of storing or processing the value and it would not be called until the content is fully loaded, so it can also signal the arrival of the data. Most JSONP servers accept a URL argument (usually called `callback`) which contains the name of the function to wrap the data with. Namespaced functions such as `YAHOO.example.SiteExplorer.callback` are a wise option for callback functions.

An important issue is to be considered: JSONP is by no means as secure as JSON. JSON does not allow any sort of executable code in the field values. Though, in principle, any good JSON encoder should prevent code from being injected into the JSON output, YUI's [JSON utility](http://developer.yahoo.com/yui/json/) also checks that none is received. This is not the case with JSONP where anything received will be happily executed, with all sorts of possible side-effects, no questions asked. In JSONP, you are basically asking a foreign server to produce a script to load. Thus, be careful to use JSONP with trusted servers and, if you plan to provide JSONP from your server, make sure to use a good JSON encoder before wrapping the results in the callback so that any field that might contain fraudulent code gets escaped and thus neutralized. Just as we learned about [SQL Injection](http://en.wikipedia.org/wiki/SQL_injection) and how to prevent it, remember JSONP shares this kind of [vulnerability](http://en.wikipedia.org/wiki/JSONP#Basic_Security_concerns).

The YQL service supports JSONP; in the console, an extra input box appears to the right of the JSON checkbox, initially containing the text `cbfunc`.

![](/yuiblog/blog-archive/assets/yql-callback-20100809-113007.jpg)

This is translated to an extra parameter in querystring. If we select JSON, the URL changes from:

```
http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20
	      geo.places%20where%20text%3D%22san%20francisco%2C%20ca%22
```

to

```
http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20
	     geo.places%20where%20text%3D%22san%20francisco%2C%20ca%22&
	     format=json&callback=cbfunc
```

The basic URL takes a `q` argument containing the URL-encoded query. For JSON we may specify `format=json` and to make it JSONP we provide the name of the `callback` function. An optional `diagnostics=true` argument may be added to get some extra diagnostics information in the response.

### Using YQL as a Source of Data in YUI

Jonathan LeBlanc has also written a convenient [utility](http://github.com/jcleblanc/yql-utilities/tree/master/js-yql-display/) to do YQL queries and format their results based on a simple template, which he presented in a [YUI Blog article](/yuiblog/blog/2009/06/17/yui-and-yql/). You just need to provide the YQL query, the template to format the result and the container for the result and it takes care of all the minutiae for us.

```
yqlWidget.push(
   // query
   'select item.description from weather.forecast where location = 90210',  
   // configuration options
   {},
   // template with placeholders with field names inside curly brackets
   '<br style="clear:both" />{item.description}',
   // id of the container for the results
   'widgetContainer'
);
yqlWidget.render();
```

Any number of fields can be requested in the query; even nested fields such as `item.description` can be used in the template by enclosing them in curly brackets.

### YQLDataSource

The YQLDataSource class takes Jonathan's work one step further by transforming the YQL data into a formal DataSource object that YUI can make use of. The result of a YQL query is usually some tabular information. YUI's [DataSource](http://developer.yahoo.com/yui/datasource/) component is designed to retrieve this type of information. Several other YUI components use DataSource to fetch their data, including [AutoComplete](http://developer.yahoo.com/yui/autocomplete/), [Charts](http://developer.yahoo.com/yui/charts/) and [DataTable](http://developer.yahoo.com/yui/datatable/). Some time ago I developed a subclass of DataSource, [YQLDataSource](http://www.satyam.com.ar/yui/2.8.0/YQLDataSource.js) that extends `YAHOO.util.ScriptNodeDataSource` to connect to the YQL web service to fetch data from it. I used it in [this example](http://www.satyam.com.ar/yui/2.8.0/nested1.html), where the data for an AutoComplete box and two levels of nested DataTables are provided by YQLDataSource (the nested DataTables will be the subject of a further article).

YQLDataSource is simple and could be simpler still. In the constructor we set the default URL for the YQL web service, if none is explicitly given by the developer:

```
YAHOO.util.YQLDataSource = function (oLiveData, oConfigs) {
	    oLiveData = oLiveData || 'http://query.yahooapis.com/v1/public/yql?format=json&q=';
	    YAHOO.util.YQLDataSource.superclass.constructor.call(this, oLiveData, oConfigs); 
	};
```

As part of the URL we already establish the format of the reply as JSON and add the `q` argument to receive the YQL query.

Just as all other DataSource subclasses do, we copy over the static members, mostly constants, that we can use:

```
YAHOO.lang.augmentObject(YAHOO.util.YQLDataSource, YAHOO.util.DataSourceBase);
```

When extending the ScriptNodeDataSource, we override several of its members, the first of them being the `responseType` since we know the `responseType` will be JSON:

```
YAHOO.lang.extend(YAHOO.util.YQLDataSource, YAHOO.util.ScriptNodeDataSource, {
	    responseType:YAHOO.util.DataSource.TYPE_JSON,
```

Since we will receive a YQL statement as the request, we need to escape it before allowing it to be concatenated into the rest of the URL. We do that in the `makeConnection` method, which we override thus:

```
makeConnection : function(oRequest, oCallback, oCaller) {
	     YAHOO.util.YQLDataSource.superclass.makeConnection.call(this,
	          encodeURIComponent(oRequest),oCallback,oCaller);
	}
```

We call the original version with the `oRequest` argument, which contains the YQL query, properly escaped.

Now we add some magic. We'll assume that we've been careful and explicitly enumerated the fields to retrieve. I dislike seeing `Select *` statements in production code; they're fine for exploring but wasteful in an end product. Thus, I'll trust that whatever fields come in the response are the ones we really wanted. Unfortunately, YQL does not return a list of fields nor their data type; moreover, depending on the query, fields such as dates might show up in very different formats. Since YQL is no more than an intermediary, the values it returns are those from the original source in whichever format they are provided, which accounts for the different formats of values such as dates or Booleans.

So, in the end, we will trust whatever comes in the results but, if some piece of data is not in the proper format, we'll still allow a parser to be specified. For example, to sort a column containing numbers in YUI DataTable, number fields need to be actual JavaScript numbers, not just strings containing digits. The YQL query for the tracks of a particular album returns the numeric values as strings, so we need to parse them into numbers. We can say:

```
var tracksDS = new YQLDS('', {
	    responseSchema: {
	        fields:[
	            {key:'Track.discNumber', parser:'number'}, 
	            {key:'Track.trackNumber', parser:'number'},
	            {key:'Track.duration', parser:'number'},
	            {key:'Track.popularity', parser:'number'}
	        ]
	    }
	});
```

The query also contains a `title` field, which is a string and needs no parsing. Also note that the data is nested a level further down so we use dot-notation to fetch it. If the first row of data, which we use to figure out what fields are coming, is not representative of the structure of the response, the fields missing in that first row can be specified as well and, finally, if for some reason the data is not located where YQLDataSource assumes, we can also specify the `resultsList`.

We won't go into every detail here; the source code contains comments that will guide you through the steps. Enough to say that the `parseJSONData` method is overridden so, before the original method is called, all the field information is extracted from the first row of the data about to be parsed and combined with whatever the developer has specified. In this method we also add the `responseSchema.metaFields` property, if not already present, to extract meta-information that is always available on the query, the number of records returned (`count`),when the result set was created (`created`) and the language of the data (`lang`).

[![](/yuiblog/blog-archive/assets/satyam-yql-ds-example-20100809-115849.jpg)](http://satyam.com.ar/yui/2.8.0/YQLDataSource.html "YQL DataSource")

For simple cases, I built [this example](http://satyam.com.ar/yui/2.8.0/YQLDataSource.html) which uses YQLDataSource and is able to fill a given container with the results of a query based on a template. The function can be called like this:

```
YAHOO.example.YQLSubstitute(
	    'list',
	    'select title, abstract, url, source from search.news where query="barcelona"',
	    '<li><h2>{title}<\/h2><p>{abstract}<\/p><address><a href="{url}">{source}<\/a><\/address><\/li>'
	);
```

I called the function `YQLSubstitute` and placed it under the `YAHOO.example` namespace. It takes the following arguments:

1.  A reference to or the id of the HTML that will contain the results (in this case, a reference to a `<ul id='list'>` element elsewhere in the page).
2.  The YQL statement to execute.
3.  The template with the field names as placeholders
4.  An optional configuration object.
    

Since the query is supported by YQLDataSource, it is possible to use dot-notation to specify nested fields in the placeholders. The optional fourth argument, the configuration options, is passed straight through to the YQLDataSource so, if any parser is needed, they can be set here. Additionally, the `YQLWebService` configuration option lets you override the URL of the YQL web service.

### YQL and YUI 3

For YUI 3, there are still not many other components that can consume the data from a DataSource and DataSchema so, for the time being, I used Dav Glass' [YQLQuery](http://yuilibrary.com/gallery/show/yql) gallery module which will be part of the 3.2.0 release. In the [YQLSubstitute](http://satyam.com.ar/yui/3.0.0/YQLSubstitute.html) example for YUI 3 I tried to provide the same interface as in the YUI 2 example, with a few exceptions. The first argument is a CSS3 selector as is customary in YUI 3; nested fields and parsers are not available and there is no extra configuration option, just the first three mandatory arguments. Both examples are well commented, just scroll down to reach the comments after the query output.

### Conclusion

In this article we have:

-   seen what YQL is and explored the YQL Console which lets us put together a YQL query and see the resulting output provided in several formats
-   explained what JSONP is and how to use it with the YUI Get Utility
-   linked to a few examples that use Get to query YQL tables and present the results
-   seen the YQLDataSource and how it works, including examples with AutoComplete and DataTable
-   defined a YQLSubstitute function using YQLDataSource
-   defined the same function for YUI3 using the YQLQuery gallery component

Do explore the many links provided along the article; the examples are real-life queries going straight to the YQL web service. Remember to scroll down past the sample output to read the descriptions and the commented code.