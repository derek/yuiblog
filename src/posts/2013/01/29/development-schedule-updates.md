---
layout: layouts/post.njk
title: "Development Schedule Updates"
author: "Andrew Wooldridge"
date: 2013-01-29
slug: "development-schedule-updates"
permalink: /2013/01/29/development-schedule-updates/
categories:
  - "Development"
---
### Next Sprint

We've started our latest sprint (called Sprint 5). If you follow our [project calendar](https://github.com/yui/yui3/wiki/Development-Schedule) you'll find that we've added some additional milestones to reflect the 72 hour window specified in our [Contributor Model](https://github.com/yui/yui3/wiki/Contributor-Model). The new sprint has the following milestones.

-   **January 28, 2013:** Sprint Begins.
    
-   **February 12, 2013:** Feature Complete Pull Request Deadline.
    
-   **February 15, 2013:** Feature Complete Code Freeze.
    
-   **February 19, 2013:** Stable Release Pull Request Deadline.
    
-   **February 22, 2013:** Stable Release Code Freeze.
    
-   **February 26, 2013:** Stable Release.
    

We have [bug tracking reports](http://yuilibrary.com/projects/yui3/report/) created for this sprint to allow you to easily keep track of the features and bugs being worked on this time around. We are continuing our [branch strategy](https://github.com/yui/yui3#branches) and quick release cycles. [Report 138](http://yuilibrary.com/projects/yui3/report/138) pertains to `3.CURRENT.NEXT` which includes features and bugfixes for the current release (say for a **3.8.2** release) and [report 139](http://yuilibrary.com/projects/yui3/report/139) pertains to `3.NEXT` which includes code for the next major release (say **3.9.0**). You may also find developers filing issues in GitHub [under two new milestones](https://github.com/yui/yui3/issues/milestones) for this sprint. If you are issuing pull requests, be sure to note that you should issue them against `dev-master` or `dev-3.x` depending on the desired release for your pull request.

### Where is 3.9.0?

The process for deciding whether to issue a major release (in this case **3.9.0**) or a minor release (say **3.8.2**) depends on the state of each branch at the time of the Stable Release deadline. If we feel that the `3.x` branch is stable and ready to go, we will issue a **3.9.0** release. Otherwise we will release **3.8.2** off of the `master` branch. Check out the [release process](https://github.com/yui/yui3/wiki/Contribution-Standards) under the Contribution Standards document for more details.

We currently have a [3.9.0pr2](/yuiblog/2013/01/25/yui-3-9-0pr2/) that we are testing for features and stability. You can download this and try it out right now to help us [find any issues](http://yuilibrary.com/projects/yui3/newticket/). **Happy testing!**