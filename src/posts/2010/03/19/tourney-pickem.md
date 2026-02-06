---
layout: layouts/post.njk
title: "Using YUI 3 to Build the Yahoo! Sports Tourney Pick'em Game"
author: "YUI Team"
date: 2010-03-19
slug: "tourney-pickem"
permalink: /blog/2010/03/19/tourney-pickem/
categories:
  - "Development"
---
Every March, users all around the world flock to Yahoo! Fantasy Sports to play our NCAA Tournament bracket game, "[Tourney Pick'Em](http://tournament.fantasysports.yahoo.com/)." It's one of our most popular games.

In many ways, it's also one of our simplest. Just fill out your bracket by selecting the teams you expect will win. Sounds easy, right? Well there's a catch -- there are [9,223,372,036,854,780,000](http://sportsnationblog.blogspot.com/2008/03/yahoo-second-chance-ncaa-college.html) different possible ways you can fill your bracket out.

That absurdly huge number presents a challenge for us as well. How do you make something with 9 quintillion possible combinations so easy-to-use that a user can fill out their brackets in just a couple of minutes? The answer involves a fair amount of JavaScript beneath the hood, which we call our "bracket engine".

The bracket engine we had been using since 2004 had served us well, but after six NCAA tournaments it was beginning to show it's age. The YUI Library didn't even exist when it was first written (for that matter, neither did JSON or Firebug). So for this year's game, we decided that instead of the incremental improvements we normally make, we'd start from scratch. Rebuilding from the ground up gave us the opportunity to completely modernize our bracket engine, so it's only fitting that we went as modern as we could by using YUI 3. This would be one of the first projects Yahoo! Fantasy Sports has built with YUI 3; but, at this point, we knew that the strengths of the library were too great to pass up. Happily, the new bracket engine turned out even better than we had hoped for.

[![Yahoo! Fantasy Sports Tourney Pick'em](/yuiblog/blog-archive/assets/tourney-blog-dnd-20100319-065945.jpg)](http://tournament.fantasysports.yahoo.com/t2 "Yahoo! Sports Second Chance Tournament Pick'em")

[YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") turned out to be ideally suited for building the complex interactions we wanted for the bracket engine. We switched from an entirely click-based interface to a drag and drop interface, and [YUI 3's drag-and-drop capabilities](http://developer.yahoo.com/yui/3/dragdrop/ "YUI 3: Drag & Drop") are so easy to use it was practically the first thing we got working. We switched from an interface built entirely by JavaScript to one where the bracket is drawn with HTML and CSS and then enhanced with JavaScript. This meant some pretty deep dives into the DOM, but YUI 3's use of CSS selectors nearly everywhere made short work of those.

Going into this project, I knew that the drag-and-drop and CSS selector capabilities of YUI 3 would prove invaluable, but I kept being surprised at how useful many other components of YUI 3 would be. For this post, I'd like to explore one that doesn't get as much attention: `Y.Base`. ([Base](http://developer.yahoo.com/yui/3/base) is part of YUI's component infrastructure, and YUI engineer [Satyen Desai has a nice introduction to that set of tools on YUI Theater](http://developer.yahoo.com/yui/theater/video.php?v=desai-yuiconf2009-widgets).)

### Y.Base is Pumpin'

While working on the Bracket Engine, I found that `Y.Base` was incredibly useful. There are two valuable things you get for free with `Y.Base`: attributes and event targeting. Both were significantly more useful than I had expected. YUI 3 doesn't require you to use `Y.Base` when creating your own classes, but for any class I build that's even slightly non-trivial, I'm going to use `Y.Base` as my starting point.

### Attributes

Attributes give you the ability to easily configure an object when you instantiate it. If you've used many YUI widgets or utilities, this will be familiar:

```
var config = {
    'node': node,
    'duration': 0.25,
    'easing': Y.Easing.easeOut
};
var anim = new Y.Anim(config);

```

In the example above the `config` variable is an example of attributes in action. But you get more than just simplifying the process of instantiating complex objects. You can define getters, setters, default values, etc. But for me, the real power comes as attribute values are changed. Immediately before and immediately after you change an attribute's value, an event is fired, allowing your code to respond to changes to your object.

For instance, in our bracket engine, when a user clicks on a little icon for a matchup, a popup opens that displays information about how the two teams stack up against each other.

The popup is represented in JavaScript by a class we call `MatchupPanel`. `MatchupPanel` has an attribute named `matchup` which stores a reference to the matchup object being displayed. An event listener within `MatchupPanel` swings into action anytime the `matchup` attribute changes. So to change what matchup we're displaying in the popup, we simply change the `matchup` attribute.

```
var MatchupPanel = function() {
    MatchupPanel.superclass.constructor.apply(this, arguments);
}

MatchupPanel.NAME = "matchuppanel";
MatchupPanel.ATTRS = {
    "teamA": { value: null },
    "teamB": { value: null },
    "container": { value: null },
    "matchup": { value: null },
    ...
};

Y.extend(MatchupPanel, Y.Base, {
    initializer: function() {
        ...
        this.after("matchupChange", this.afterMatchupChange);
    },
    ...
    afterMatchupChange: function(e) {
        var m = this.get("matchup");
        if(m) {
            var game1 = m.get("game_1");
            var game2 = m.get("game_2");
            var team_1 = game1.getValue();
            var team_2 = game2.getValue();
            if(team_1 && team_2) {
                this.setupDisplay(team_1, team_2);
                this.show();
            }
            else {
                this.hide();
            }
        }
        else {
            this.hide();
        }
    },
    ...
}
  
```

### Events

`Y.Base` also incorporates YUI 3's [custom events and custom event bubbling](http://developer.yahoo.com/yui/3/examples/event/event-ce.html "YUI Library Examples: Event: Using Custom Events"). This means that not only is it easy to create and fire custom events, it's easy for other objects to respond to them, including stopping propagation as the event bubbles up the chain of targets you've specified, just as browser events bubble up the DOM hierarchy.

For the brackets, we used this in a few places. For instance, as the user advances teams through the rounds, new matchup combinations are formed. The winner of the first and second games in round one face each other in the first game in round two, and we have to display the icon for the matchup popup.

The `Matchup` object is responsible for showing or hiding the icon, while each game within a matchup is represented by a `TeamGame` object. When a team is advanced into a `TeamGame` object, the object fires an event. By declaring that the `Matchup` object is a target for the `TeamGame`'s events, the `Matchup` knows when one of its games changes and can hide or show the icon as necessary.

Here's a (very) simplified example of this in action for the `Matchup` object:

```
var Matchup = function() {
    Matchup.superclass.constructor.apply(this, arguments);
}


Matchup.NAME = "matchup";
Matchup.ATTRS = {
    "container": { value: null },
    "game_1":    { value: null },
    "game_2":    { value: null },
    "id":        { value: null },
    "infotrigger": { value: null }
    ...
}


Y.extend(Matchup, Y.Base, {
    initializer: function(cfg) {
        var li = this.get("container");
        var games = li.all("li.ysf-tpe-game");
        ...
        //create the TeamGame objects for this matchup
        for(var x=0; x<games.size(); x++) {
            var gameNode = games.item(x);
            
            var gameobj = new TeamGame({
                "matchup": this, 
                "container": gameNode
            });
            if(this.get("game_1") == null) {
                this.set("game_1", gameobj);
            }
            else if(this.get("game_2") == null) {
                this.set("game_2", gameobj);
            }
            
            // allow the TeamGame's events bubble to this matchup
            gameobj.initTarget(this);
            
        }
        ...
    },
    initHandlers: function() {
        this.on("teamgame:changed", this.onMatchupChange);
        this.onMatchupChange();
    },
    onMatchupChange: function(e) {
        // Whenever one of the this matchup's games changes
        // this will check to see if the info icon needs to 
        // be hidden or displayed.
        ...
   },
   ...
}

```

... and for the `TeamGame` object:

```
var TeamGame = function() {
    TeamGame.superclass.constructor.apply(this, arguments);
    this.publish("changed", {prefix: "teamgame"});
}


TeamGame.NANE  = "teamgame";
TeamGame.ATTRS = {
    "container": { value: null },
    "matchup":   { value: null },
    "select":    { value: null },
    "gameid":    { value: null }
    ...    
}

Y.extend(TeamGame, Y.Base, {
    initializer: function(cfg) {
        var cont = this.get("container");
        if(cont) {
            var sel = cont.one("select");
            this.set("select", sel);
            var sid = cont.getAttribute("id");
            var gameid = TeamGame.getGameId(sid);
            this.set("gameid", gameid);
        }
    },
    initTarget: function(matchup) {
        // Allow a matchup to be a target for this game's events.
        var targ = matchup || this.get("matchup");
        this.addTarget(targ);
    },
    setValue: function(val) {
        // sets the select menu to a given value.
        // this is what happens behind the scenes when
        // a user makes their picks.
        var oldValue = this.getValue();
        var sel = Y.Node.getDOMNode(this.get("select"));
        var opts = sel.options;
        var selIdx = null;
        for(var x=0; x<opts.length; x++) {
            if(opts[x].value == val) {
                selIdx = x;
            }
        }
        if(selIdx !== null) {
            sel.selectedIndex = selIdx;
            var newValue = this.getValue();
            var gameid = this.get("gameid");
            this.fire("teamgame:changed", {
                "game": gameid, 
                "old": oldValue, 
                "new": newValue
            });
            return selIdx;
        }
        return false;
    },
    getValue: function() {
        var select = this.get("select");
        return parseInt(select.get("value"));
    },
    ...
}
       

```

By combining Events and Attributes into an easily extended class, `Y.Base` takes care of a lot of the plumbing a complex web app requires. To me, the biggest benefit of this is that I can sketch out a quick boxes-and-arrows diagram of how I want my app to work, and quickly turn that into working JavaScript.

If you want to see all of this (and more) in action, there's still time to sign up for our other NCAA Tournament game, "[Second Chance Tourney Pick'Em](http://tournament.fantasysports.yahoo.com/t2)". And this one is a bit easier, there's only 32,768 ways to fill out the bracket.