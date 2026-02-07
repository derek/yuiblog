---
layout: layouts/post.njk
title: "Date Formatting with YUI - Part IV"
author: "Philip Tellis"
date: 2009-07-06
slug: "date-formatting-pt4"
permalink: /2009/07/06/date-formatting-pt4/
categories:
  - "Development"
---
In [Part I](/yuiblog/2009/02/11/date-formatting-pt1-2/) of this series, we introduced date formatting with the YUI Date utility and integrated it with the DataTable control in [Part II](/yuiblog/2009/02/25/date-formatting-pt2/) and the Charts control in [Part III](/yuiblog/2009/03/18/date-formatting-pt3/). In this final part, we'll look at date localisation with YUI.

To recap, we can format dates using YUI using the [`YAHOO.util.Date`](http://developer.yahoo.com/yui/docs/YAHOO.util.Date.html) class, which is currently distributed as part of the [DataSource](http://developer.yahoo.com/yui/datasource/) utility. Any valid `strftime` format specifier is supported, so for example, `YAHOO.util.Date.format(new Date(), { format: "%Y-%b-%d"});` would return the date as `<four digit year>-<short month name>-<two digit day of month>`.

The Date utility accepts an optional third parameter, which specifies the locale to use when formatting a date. If not specified, this defaults to `"en"`. The locale is a string that may be the two-letter [ISO-639-1 language code](http://en.wikipedia.org/wiki/ISO_639-1), optionally followed by a hyphen and a two-letter [ISO-3166-1 country code](http://en.wikipedia.org/wiki/ISO_3166-1). For example, `fr` is used for French, while `fr-CA` is used for the dialect of French spoken in Canada, and `fr-CH` is used for the dialect of French spoken in Switzerland. `de-CH`, on the other hand, is the dialect of German spoken in Switzerland.

Examples of valid locale codes
| Locale Code | Language |
| --- | --- |
| en | English (default) |
| fr | French |
| fr-CA | French dialect spoken in Canada |
| fr-CH | French dialect spoken in Switzerland |
| de | German |
| de-DE | German dialect spoken in Germany |

The locale code impacts only the following format specifiers:

%a

abbreviated weekday name according to the current locale

%A

full weekday name according to the current locale

%b

abbreviated month name according to the current locale

%B

full month name according to the current locale

%c

preferred date and time representation for the current locale

%h

same as %b

%p

either "AM" or "PM" according to the given time value, or the corresponding strings for the current locale

%P

like %p, but lower case

%r

time in AM and PM notation equal to %I:%M:%S %p

%x

preferred date representation for the current locale without the time

%X

preferred time representation for the current locale without the date

### Built-in locales

Let's start off by looking at the built-in locales. The Date utility includes the following locales by default:

-   en - English (the default)
-   en-US - US English
-   en-GB - British English
-   en-AU - Australian English (identical to British English)

In the following example, we'll print out the locale-specific date format using the built-in locales:

```
var d = new Date();
var f = { format: "%x%n" };
var s = "%x:\n";
s += "  Default:\t" + YAHOO.util.Date.format(d, f);
s += "  en-US:\t" + YAHOO.util.Date.format(d, f, "en-US");
s += "  en-GB:\t" + YAHOO.util.Date.format(d, f, "en-GB");

alert(s);

```

[See a working example](/yuiblog/blog-archive/assets/dateformatting/locale-example1.html). Note the different output for en-US and en-GB. Similar differences between these two locales can be seen for `%r`, `%c`, and `%X`.

### Supporting other languages

Now, there are many languages other than English, and many web applications that cater to speakers of these languages which the date formatter should support. While these aren't provided by YUI itself, it is fairly easy to add your own locale patch. Let's create one now for French. We do this by mixing in the `YAHOO.util.DateLocale` class with our locale definitions using the [YAHOO.lang.merge](http://developer.yahoo.com/yui/docs/YAHOO.lang.html#method_merge) method:

```
YAHOO.util.DateLocale["fr"] = YAHOO.lang.merge(YAHOO.util.DateLocale, {
	a: ["dim", "lun", "mar", "mer", "jeu", "ven", "sam"],
	A: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
	b: ["jan", "fév", "mar", "avr", "mai", "jun", "jui", "aoû", "sep", "oct", "nov", "déc"],
	B: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
	c: "%a %d %b %Y %T %Z",
	p: ["", ""],
	P: ["", ""],
	x: "%d.%m.%Y",
	X: "%T"
});

var d = new Date();
var f = { format: "%c%n" };
var s = "%c:\n";
s += "  Default:\t" + YAHOO.util.Date.format(d, f);
s += "  fr:   \t" + YAHOO.util.Date.format(d, f, "fr");

alert(s);

```

[Try it out](/yuiblog/blog-archive/assets/dateformatting/locale-example2.html).

Similarly, we can create one for Canadian French by using the French locale as a base. The only difference is in the locale-specific date format `%x`:

```
YAHOO.util.DateLocale["fr-CA"] = YAHOO.lang.merge(YAHOO.util.DateLocale["fr"], {
	x: "%Y-%m-%d"
});

var d = new Date();
var f = { format: "%A, %x%n" };
var s = "%A, %x:\n";
s += "  Default:\t" + YAHOO.util.Date.format(d, f);
s += "  fr:   \t" + YAHOO.util.Date.format(d, f, "fr");
s += "  fr-CA:\t" + YAHOO.util.Date.format(d, f, "fr-CA");
s += "  fr-CH:\t" + YAHOO.util.Date.format(d, f, "fr-CH");
s += "  de-CH:\t" + YAHOO.util.Date.format(d, f, "de-CH");

alert(s);

```

[Try it out](/yuiblog/blog-archive/assets/dateformatting/locale-example3.html).

Notice that we also try to access `fr-CH` and `de-CH` which haven't been defined. In this case, the Date utility falls back to a less specific locale and tries `fr` and `de` instead. Since `de` hasn't been defined either, it falls back to `en`, which is built in.

I've included definitions for a few locales as examples. If you'd like to use these locales, it may make more sense to just include the code directly in your HTML pages, or copy the files to your own servers.

-   [fr](/yuiblog/blog-archive/assets/dateformatting/datelocale-fr.js) - French, Canadian French and Swiss French
-   [de](/yuiblog/blog-archive/assets/dateformatting/datelocale-de.js) - German, and Swiss German
-   [hi](/yuiblog/blog-archive/assets/dateformatting/datelocale-hi.js) - Hindi
-   [ko](/yuiblog/blog-archive/assets/dateformatting/datelocale-ko.js) - Korean