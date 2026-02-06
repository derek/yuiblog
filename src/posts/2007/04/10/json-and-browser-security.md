---
layout: layouts/post.njk
title: "JSON and Browser Security"
author: "YUI Team"
date: 2007-04-10
slug: "json-and-browser-security"
permalink: /blog/2007/04/10/json-and-browser-security/
categories:
  - "Development"
---
[JSON](http://www.JSON.org/) is a data interchange format. It is used in the transmission of data between machines. Since it carries only data, it is security-neutral. The security of systems that use JSON is determined by the quality of the design of those systems. JSON itself introduces no vulnerabilities.

The web browser is a peculiar application environment. The security model of the browser was forged through a long series of foreseeable and painful blunders. Most of the holes in the browser have been plugged, but in some cases the plugs become annoyances which must be circumvented, and that circumvention leads, foreseeably and ever-painfully, to a continuing series of blunders.

This pain can be avoided by adopting good practices. Often, so-called experts seem to be incapable of distinguishing the good practices from the bad ones, so there is a lot of bad advice available on the web.

I will share here a small set of principles which can be seen to be true. If you hold to these principles, you will be much less likely to adopt bad practices.

### Never Trust The Browser

The browser cannot and will not protect your secrets, so never send it your secret sauce. Keep your critical processes on the server. If you are doing input validation in the browser, it is for the user's convenience. Everything that the browser sends to the server must be validated.

### Keep Data Clean

JSON is a subset of JavaScript, which makes it especially easy to use in web applications. The `eval` function can take a text from `XMLHttpRequest` and instantly inflate it into a useful data structure. Be aware however that the `eval` function is extremely unsafe. If there is the slightest chance that the server is not encoding the JSON correctly, then use the `parseJSON` method instead. The `parseJSON` method uses a regular expression to ensure that there is nothing dangerous in the text. The next edition of JavaScript will have `parseJSON` built in. For now, you can get `parseJSON` at [http://www.JSON.org/json.js](http://www.JSON.org/json.js).

On the server side, always use good JSON encoders and decoders.

### Script Tags

Script tags are exempt from the Same Origin Policy. That means that any script from any site can potentially be loaded into any page. There are some very important consequences of this.

Any page that includes scripts from other sites is not secure. External scripts can be used to deliver ads or search result options, or logging, or alerts, or buddy lists, or lots of other nice things. Unfortunately, the designs of JavaScript and the DOM did not anticipate such useful services, so they offer absolutely no security around them. Every script on the page has access to everything on the page. When you load a script on a page, you are authorizing that script to have access to all of your confidential information and all of your user's confidential information. You are also authorizing that script to access your server on the user's behalf to do anything it wants. It is not possible to distinguish between requests made by the user and requests made by an invited script. Hopefully, some day soon, browsers will offer some degree of [modularity](http://json.org/module.html) that would limit the danger. Until then, script tags are extremely dangerous.

Another use of script tags is to deliver JSON data from different sites. There is absolutely no protection against the case where the different site sends dangerous scripts instead of benign JSON data. Hopefully, some day soon, browsers will offer [safe cross-site data transport](http://json.org/JSONRequest.html). Script tags are too dangerous to use for data transport.

Script tags can also be used to deliver Ajax Libraries. Do not load libraries from other sites unless you have a high level of trust in the vendors.

### Don't Send Data To Strangers

If your server sends sensitive data to an evil web page, there is a good chance that the browser will deliver it. In some cases the Same Origin Policy is supposed to block such deliveries, but the fact is that browsers are buggy and sometimes the data will go through. It doesn't make sense to get mad at the browser. The secure release of confidential information is the server's responsibility. That responsibility should never be delegated to the browser.

All requests must be authenticated. You must have some secret which is known only by the page that indicates that it should be given the goods. Cookies are not adequate authentication. Don't use a cookie as the secret. JSON often works best in a dialog: `POST` a request including the secret in the JSON payload, and get a JSON response in return along with a new secret.

Since script tags are exempt from the Same Origin Policy, a script tag can be used from any page to make a `GET` request of your server. The request will even include your cookies. If the response contains confidential information, then your server must refuse the request.

There are people who are selling magic wrappers to put around JSON text to prevent delivery to unauthorized receivers. Avoid that stuff. It will fail when new browser bugs are created and discovered, and in some cases might introduce painful new exploits.

### Use SSL

Any time you are transmitting confidential information or requests for confidential information, use SSL. It provides link encryption so that your secrets are not revealed in transit.