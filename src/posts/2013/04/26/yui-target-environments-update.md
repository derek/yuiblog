---
layout: layouts/post.njk
title: "YUI Target Environments Update"
author: "Jenny Donnelly"
date: 2013-04-26
slug: "yui-target-environments-update"
permalink: /2013/04/26/yui-target-environments-update/
categories:
  - "Development"
---
We’re pleased to announce a small update to our target environments matrix to reflect the changing landscape of user environments in our customer base. In order to focus our resources on the environments most widely used by our customers’ end users, we have officially removed Android 2.2, iOS 4.†, Node.js 0.4.†, and Node.js 0.6.† target environments from our automated testing system and added Node 0.10.†. Our process is data driven, and thus we will continue to vigilantly monitor usage of older IE browsers in order to remove them as soon as the data supports the decision. We also look forward to onboarding emerging environments in the near future, such as Firefox OS.

.environments th { text-align: left; } .environments { border-collapse: collapse; width: 100%; } .environments td, .environments th { border: 1px solid #fff !important; padding: 5px 12px; vertical-align: top; } .environments td { background: #E6E9F5; text-align: center; } .environments th { background: #D2D7E6; border-bottom: none; border-top: none; color: #000; font-weight: bold; line-height: 1.3; white-space: nowrap; } /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

<table class="environments"><tbody><tr><th>Internet Explorer</th><td>6.0</td><td>7.0</td><td>8.0</td><td>9.0</td><td>10.0</td></tr><tr><th>Chrome †</th><td colspan="5">Latest stable</td></tr><tr><th>Firefox †</th><td colspan="5">Latest stable</td></tr><tr><th>Safari</th><td>iOS 5.†</td><td>iOS 6.†</td><td colspan="3">Latest stable (desktop)</td></tr><tr><th>WebKit</th><td>Android 2.3.†</td><td colspan="4">Android 4.†</td></tr><tr><th>Node.js*</th><td>0.8.†</td><td colspan="4">0.10.†</td></tr><tr><th>Windows (Native)</th><td colspan="5">Windows 8 Apps</td></tr></tbody></table>

The latest set of target environments is always available at [http://yuilibrary.com/yui/environments/](http://yuilibrary.com/yui/environments/).