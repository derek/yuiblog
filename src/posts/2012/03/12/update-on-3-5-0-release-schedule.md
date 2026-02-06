---
layout: layouts/post.njk
title: "Update on 3.5.0 release schedule"
author: "Unknown"
date: 2012-03-12
slug: "update-on-3-5-0-release-schedule"
permalink: /blog/2012/03/12/update-on-3-5-0-release-schedule/
categories:
  - "Development"
---
Some of you have been wondering when YUI 3.5.0 PR3 will be released. After all, the scheduled release date for 3.5.0 PR3 was last week, March 5th, but here we are on the 12th, and no PR3. So what gives?

### Current Status

In parallel to development on YUI 3.5.0, Yahoo!'s CDN deployment process has been undergoing an upgrade. Unfortunately, while the upgrade is happening, production deployments are halted. That's why PR3 hasn't shown up on yui.yahooapis.com, and why the Gallery deployments unexpectedly stopped as well.

As of today, we are still unable to deploy new resources to our CDN at yui.yahooapis.com, but the good news is that the upgrade is scheduled to be complete on March 20th, at which point we'll kick the tires, make sure everything's working, and then get back to our regular deployments.

### So What About PR3?

The short answer is that PR3 (which has [already been tagged in git](https://github.com/yui/yui3/commit/v3.5.0pr3)) will be deployed, but simultaneously with a **new PR4 release** once the deployment process is live in production.

While we wait, we're continuing to fix bugs, add tests, and write documentation for the 3.5.0 final release. All the changes we've made since PR3 was tagged will go into this new PR4 release.

**3.5.0 PR4 is tentatively scheduled for March 21st**. We'll keep you posted if any surprises show up.

### New 3.5.0 Final Release Date

Since the upgrade caused us to miss the PR3 release date, we're going to delay the final release date of 3.5.0 to allow time for implementers (that's you guys!) to test the changes in PR3 and PR4 and provide feedback before the final release.

**3.5.0 final is tentatively scheduled for April 3rd**. We will post another update when the date is finalized.

We're very sorry for the delay. After all the hard work that's gone into it, we're very eager to see 3.5.0 out the door!