---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Base64 and Y64 encoding"
author: "Nicholas C. Zakas"
date: 2010-07-06
slug: "in-the-yui-3-gallery-base64-and-y64-encoding"
permalink: /2010/07/06/in-the-yui-3-gallery-base64-and-y64-encoding/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
[Base64](http://en.wikipedia.org/wiki/Base64) encoding was originally designed to allow lossless data passing between 8-bit and 7-bit systems. The primary example of its usage is in email, which traditionally used 7-bit systems to transfer the email while those of us at home on our computers were using 8-bit systems. This became especially important with non-text email attachments, which would be encoded into MIME base64 and sent along to the destination. More recently, base64 encoding has gained popularity for its usage in data URIs. For those unaware, data URIs are a way of embedding files inside of HTML and CSS. One of the supported data URI formats is base64. Base64 encoding is still used frequently in programming, primarily for obfuscation but also for safe data transport. While some browsers have native base64 encoding and decoding, this functionality isn't defined in any standard nor commonly available in all browsers. The [YUI 3 Gallery Base64 module](http://yuilibrary.com/gallery/show/base64) provides a common implementation of base64 encoding that can be used across all A-grade browsers. To use the Base64 module, include the following on your page:
```
<script src="http://yui.yahooapis.com/3.1.0/build/yui/yui-min.js"></script>
<script>
YUI({
    gallery: 'gallery-2010.06.16-19-51'
}).use('gallery-base64', function(Y) {

    //your code here 
});
</script>
```
The Base64 module exposes a `Base64` object with two methods: `encode()` and `decode()`. The methods are used as follows:
```
var decodedText = Y.Base64.decode(encodedText);
var encodedText2 = Y.Base64.encode(rawText);
```
Along with the Base64 module, I also wrote a [Y64 module](http://yuilibrary.com/gallery/show/y64). Y64 is a base64 variant used at Yahoo! when base64 information needs to be transmitted as part of a GET request. Regular base64 has three characters that aren't URL-safe: plus (+), slash (/), and equals (=). Y64 encoding replaces these with dot (.), underscore (\_), and dash (-), respectively. This allows Y64-encoded strings to be placed in URLs without worrying about URL escaping of the characters. The Y64 module requires the Base64 module, which is automatically pulled in when you include the following code:
```
YUI({
    gallery: 'gallery-2010.06.16-19-51'
}).use('gallery-y64', function(Y) {
    //your code here
});
```
The Y64 module exposes a `Y64` object with `encode()` and `decode()` methods, so it usage is the same as with the `Base64` object:
```
var decodedText = Y.Y64.decode(encodedText);
var encodedText2 = Y.Y64.encode(rawText);
```
If you're planning on passing base64-encoded data in a URL string, you may want to consider Y64 as an alternative. Please keep in mind that base64 and Y64 are _not_ encryption algorithms. Encryption algorithms are designed to secure data from prying eyes. Base64 and Y64 are `encoding` algorithms designed to transmit data without the risk of data corruption - the type of corruption that happens when data is transferred from one system to the next and may be encoded and decoded in many different formats before arriving at the final destination. A good example of this is link-sharing functionality. Suppose that you're sharing a link by passing it to an entrypoint, such as `http://www.example.com?share=<url>`. The `url` needs to be URL-encoded for safe transmission, but that URL itself may also contain URL-encoded data. And believe it or not, sometimes browsers can mis-encoded URLs before transmission (it's rare, but not unheard of). For a higher level of confidence that the data will arrive in good shape, you can use Y64 encoding:
```
var destination = "http://www.example.com?share=" + Y.Y64.encode(url);
```
The destination would then decode the URL value. Because this value won't require URL-encoding, the chances of the data becoming corrupted during transmission are lessened. Not everyone will need to use base64 or Y64 encoding in their web applications, but these can be very powerful tools to keep in your back pocket.

### Further Reading:

-   [Computer Science in JavaScript: Base64 encoding](http://www.nczonline.net/blog/2009/12/08/computer-science-in-javascript-base64-encoding/)
-   [Data URIs explained](http://www.nczonline.net/blog/2009/10/27/data-uris-explained/)