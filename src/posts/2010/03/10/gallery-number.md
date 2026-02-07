---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Matt Snider's Number Module"
author: "Matt Snider"
date: 2010-03-10
slug: "gallery-number"
permalink: /2010/03/10/gallery-number/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
Natively, JavaScript has a very limited set of functions for working with numbers located on the global Math object. Mostly these functions are for working with exponents, trigonometry, and rounding. And while these functions are needed and efficient, the [Math API](http://www.w3schools.com/jsref/jsref_obj_math.asp) has remained unchanged for years, and probably won't be improved anytime in the near future. So it is up to the developers of JavaScript libraries to create and maintain a component for working with numbers.

The [Number component in the YUI 3 Gallery](http://yuilibrary.com/gallery/show/number), derived from work originally used on [Mint.com](http://www.mint.com), aims to fill in missing number-related functionality. It provides a light-weight set of static functions for working with numbers. The Number component weighs in at about 1.8kb after minification and before gzip; it's supported by all A-grade browsers.

One of the features in Number that I use the most is the `format()` function, which injects a formatted number into a string by evaluating the format of the placeholder number in the string. (Note: This is similar to the formatting support `Y.DataType.Number` currently provides, but rolls up the separate configuration properties which `Y.DataType.Number.format` accepts into a single formatting pattern string.) The function works with all symbols, but it formats numbers according to the English standard. Here are a few example of how to use `format()` from its unit test:

```
var n = 1111.11,
	formatDollars = "$0,0.00'" // use comma and decimal when formatting
	formatPercent = "0.00%", // use decimal when formatting
	formatRound = "0,000", // use comma when formatting
	formatText = "Please add the $0,0.00 to my tab!";

Y.Assert.areEqual("$1,111.11", Y.Number.format(n, formatDollars));
Y.Assert.areEqual("1111.11%", Y.Number.format(n, formatPercent));
Y.Assert.areEqual("1,111", Y.Number.format(n, formatRound));
Y.Assert.areEqual("Please add the $1,111.11 to my tab!", Y.Number.format(n, formatText));
```

Other useful functions include:

-   **`random()`**: provides an easy API for getting random whole numbers;
-   **`isBetween()`/`isNotBetween()`**: simplifies the evaluation of number ranges;
-   **`radian()`/`degrees()`**: when working with the Math trigonometry functions (such as `Math.cos()`), which expect radians instead of degrees, both `radian()` and `degrees()` are useful for converting values.

To use the Number Gallery component, first include the script:

```
<script 
src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&
gallery-2010.02.22-22/build/gallery-number/gallery-number-min.js"></script>
```

Then include `'gallery-number'` in your `use()` function, to get the following functions:

```
YUI().use('gallery-number', function(Y) {
	Y.Number = {
		degrees(number),
		format(number, format),
		getPrecision(number),
		isNotBetween(number, number, number, boolean),
		isBetween(number, number, number, boolean),
		isPrime(number),
		radians(number),
		random(number, number),
		roundToPrecision(number, number)
	};
});
```

These functions were modeled after the native Math functions and, like the Math functions, the functions on `Y.Number` return `NaN` if the value provided is not a number. If you would like to contribute to the development of or require new features added to Number, please leave a message on the [Forum](http://yuilibrary.com/forum/viewforum.php?f=112).