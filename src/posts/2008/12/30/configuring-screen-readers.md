---
layout: layouts/post.njk
title: "Configuring Your Machine For Testing With A Screen Reader"
author: "Todd Kloots"
date: 2008-12-30
slug: "configuring-screen-readers"
permalink: /blog/2008/12/30/configuring-screen-readers/
categories:
  - "Development"
---
When developing using the [WAI-ARIA Roles and States](http://www.w3.org/TR/wai-aria/), you need to test your code in a screen reader to ensure everything is working as you expect. As a follow up to my presentation on [Developing Accessible Widgets with ARIA](/yuiblog/blog/2008/12/08/video-kloots-aria/) and in the interest of helping other developers test their code, I thought I would provide some tips on how to configure your development environment for screen reader testing.

### Step 1: Install A Virtual Machine

Before I install and configure screen readers I start by installing a virtual machine. (This is mostly out of necessity because I use a Mac and the most-popular screen readers run on Windows.) Using a virtual machine provides a couple of benefits when testing with a screen reader: To start, a virtual machine provides a sandboxed environment, so I am protected if anything goes awry when I am installing and configuring each screen reader. (So as not to give the impression that screen readers are unstable pieces of software, this is definitely the exception more than the rule.)

The second benefit to using a virtual machine is that they allow you to save and restore state. This is an especially helpful feature for efficiently testing and re-testing specific pieces or states of complex web applications. So, using a virtual machine can help save you time when testing.

Which virtual machine to use? If you use Windows, you can download and install [Microsoft Virtual PC](http://www.microsoft.com/windows/downloads/virtualpc/default.mspx) for free. As a Mac user, I have found both [VMware Fusion](http://www.vmware.com/products/fusion/) and [Parallels Desktop](http://www.parallels.com/products/desktop/) work well.

### Step 2: Install Browsers

It is important to remember that to work, ARIA requires a team effort between the browser and the screen reader. To test ARIA you'll need to install browsers that both support ARIA _and are supported by screen readers that also support ARIA_. For example, [Opera](http://www.opera.com/) has support for ARIA, but is not supported by screen readers. Currently only [Internet Explorer 8](http://www.microsoft.com/windows/internet-explorer/beta/default.aspx) and [Firefox 3](http://www.mozilla.com/) have support for ARIA, and are supported by several screen readers for Windows that also offer support for ARIA.

After installing each browser, be sure to save the state of the virtual machine. That way you'll be able to quickly revert back to a clean, working state should anything go wrong during the screen reader installation.

### Step 3: Install & Configure Screen Readers

With the browsers installed the next step is to install and configure each screen reader. The two most-popular screen readers for Windows, [JAWS](http://www.freedomscientific.com/products/fs/jaws-product-page.asp) and [Window-Eyes](http://www.gwmicro.com/Window-Eyes/) support ARIA and work with both Internet Explorer 8 and Firefox 3. Free, trial versions of both products are available for download from Freedom Scientific's and GW Micro's websites. The open-source screen reader [NVDA](http://www.nvda-project.org/) also has excellent ARIA support and currently works with Firefox 3. Knowing that most visually impaired users use more than one screen reader, I recommend installing all three for testing.

As a sighted person I disable a couple of features of each screen reader and change some configurations so that I can test more efficiently. For example, most screen readers are configured to startup automatically when you start your computer. This is obviously not desirable when you have multiple screen readers installed, so I turn off that feature. Additionally, every screen reader uses a different keyboard shortcut for toggling the virtual buffer on and off. To avoid having to remember the keyboard shortcut for each screen reader, I configure them all to be the same: Ctrl + Shift + Space. (For more on the virtual buffer, read [Making Ajax Work with Screen Readers](http://juicystudio.com/article/making-ajax-work-with-screen-readers.php).)

The following sections provide step-by-step instructions for configuring JAWS, Window-Eyes and NVDA.

#### Configuring JAWS

##### Changing The Virtual Buffer Toggle Keyboard Shortcut

1.  Open the "Keyboard Manager" dialog by selecting "Utilities" -> "Keyboard Manager" in the JAWS application menubar. ![Screen shot of the JAWS menubar.](/yuiblog/blog-archive/assets/aria-env/jaws-1.png)
2.  Select the "default" profile in the left, "Profile" pane.
3.  In the right pane, sort by the "Script Name" column, then find and select the item named "VirtualPCCursorToggle".
4.  Open the "Change Keystroke" dialog by either right clicking on the "VirtualPCCursorToggle" item, or by pressing Ctrl + H. ![Screen shot of the Keyboard Manager dialog in JAWS .](/yuiblog/blog-archive/assets/aria-env/jaws-2.png)
5.  In the "Change Keystroke" dialog, choose the new keystroke by pressing the desired keys. (I use Ctrl + Shift + Space.) JAWS will warn you if the keystroke you choose in already in use. ![Screen shot of the Change Keystroke dialog in JAWS.](/yuiblog/blog-archive/assets/aria-env/jaws-3.png)
6.  Press the "OK" button to close the dialog.

##### Disabling JAWS From Starting Automatically

1.  Open the "Basic Settings" dialog by selecting "Options" -> "Basics" in the JAWS application menubar. ![Screen shot of the JAWS menubar.](/yuiblog/blog-archive/assets/aria-env/jaws-4.png)
2.  In the "Basic Settings" dialog, make sure the checkbox labeled "Automatically start JAWS" in not checked. ![Screen shot of the Basic Settings dialog in JAWS.](/yuiblog/blog-archive/assets/aria-env/jaws-5.png)

#### Configuring Window-Eyes

##### Changing The Virtual Buffer Toggle Keyboard Shortcut

1.  Open the "Browse Mode Hot Key Definitions" dialog by selecting "Hotkeys" -> "Browse Mode…" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-1.png)
2.  In the "Browse Mode Hot Key Definitions" dialog, scroll down to the item named "Browse Mode" in the scrollable "Keys" list. ![Screen shot of the Browse Mode Hot Key Definitions dialog in Window-Eyes.](/yuiblog/blog-archive/assets/aria-env/window-eyes-2.png)
3.  Select the "Browse Mode" item and then press the "Capture Key" button.
4.  Press the keyboard combination you want to use. (I use Ctrl + Shift + Space.)
5.  Press the "OK" button to close the dialog.
6.  Save the configuration by selecting "File" -> "Save" -> "Set File and All Dictionaries" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-8.png)

##### Disabling The Mouse Voice

By default Window-Eyes will speak in response to some mouse gestures. For example, when you press the left mouse button, Window-Eyes will say "left". As a sighted person I find this feature unnecessary, so I disable this feature.

1.  Open the "Mouse Voice" dialog by selecting "Mouse" -> "Voice" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-4.png)
2.  Select the "Off" item. ![Screen shot of Mouse Voice dialog in Window-Eyes.](/yuiblog/blog-archive/assets/aria-env/window-eyes-5.png)
3.  Press the "OK" button to close the dialog.
4.  Save the configuration by selecting "File" -> "Save" -> "Set File and All Dictionaries" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-8.png)

##### Disabling Window-Eyes From Starting Automatically

1.  Open the "Startup Options" dialog by selecting "File" -> "Starup Options…" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-6.png)
2.  In the "Startup Options" dialog:
    
    -   Uncheck the checkbox labeled "Run Window-Eyes at the Login Screen".
    -   Uncheck the checkbox labeled "Run Window-Eyes after login for all users".
    -   Select the radio button labeled "Never" under "After login for Current User, Run Window-Eyes".
    
    ![Screen shot of the Startup Options dialog in Window-Eyes.](/yuiblog/blog-archive/assets/aria-env/window-eyes-7.png)
3.  Press the "OK" button to close the dialog.
4.  Save the configuration by selecting "File" -> "Save" -> "Set File and All Dictionaries" in the Window-Eyes application menubar. ![Screen shot of the Window-Eyes menubar.](/yuiblog/blog-archive/assets/aria-env/window-eyes-8.png)

#### Configuring NVDA

##### General Settings For Efficiency

1.  Uncheck the checkbox labeled "Show this dialog when NVDA starts" that pops up the first time NVDA starts ![Screen shot of the NVDA welcome dialog](/yuiblog/blog-archive/assets/aria-env/nvda-1.png)
2.  Disable the confirmation dialog that pops up when you exit the application:
    1.  Open the "General settings" dialog by right clicking on the NVDA system tray icon and selecting to "Preferences" -> "General settings" in the context menu. ![Screen shot of the NVDA system tray context menu.](/yuiblog/blog-archive/assets/aria-env/nvda-5.png)
    2.  In the "General settings" dialog, uncheck the checkbox labeled "Warn before exiting NVDA". ![Screen shot of the General settings dialog in NVDA.](/yuiblog/blog-archive/assets/aria-env/nvda-6.png)
    3.  Right click on the NVDA icon in the system tray and select the "Save configuration" menu item in the context menu. ![Screen shot of the NVDA system tray context menu.](/yuiblog/blog-archive/assets/aria-env/nvda-7.png)

##### Disabling the Mouse Voice

Like Window-Eyes, by default NVDA will speak in response to some mouse gestures. For example, when you move the mouse NVDA will play tones to help the user track the position of the mouse. As a sighted person I find this feature unnecessary, so I disable this feature.

1.  Open the "Mouse settings" dialog by right clicking on the NVDA icon in the system tray and selecting "Preferences" -> "Mouse settings" from the context menu. ![Screen shot of the NVDA system tray context menu.](/yuiblog/blog-archive/assets/aria-env/nvda-2.png)
2.  In the "Mouse settings" dialog, uncheck both "Report text under the mouse" and "play audio coordinates when the mouse moves". ![Screen shot of the Mouse settings dialog in NVDA.](/yuiblog/blog-archive/assets/aria-env/nvda-3.png)
3.  Right click on the NVDA icon in the system tray and select the "Save configuration" menu item in the context menu. ![Screen shot of the NVDA system tray context menu.](/yuiblog/blog-archive/assets/aria-env/nvda-7.png)

##### Changing The Virtual Buffer Toggle Keyboard Shortcut

1.  Shut down NVDA - right click on the system track icon and choose "Exit" from the context menu.
2.  Navigate to the path "C:\\Program Files\\NVDA\\appModules". ![Screen capture of the contents of the appModules directory.](/yuiblog/blog-archive/assets/aria-env/nvda-4.png)
3.  Open the file named "\_default\_desktop.kbd".
4.  Find the line: "NVDA+space=toggleVirtualBufferPassThrough".
5.  Change to: "Control+Shift+space=toggleVirtualBufferPassThrough".
6.  Save the file.
7.  Restart NVDA.

### Step 4: Restart Windows & Save State

With all of the screen readers installed and configured, restart Windows. Once Windows is restarted, take another snapshot of the virtual machine's state. If you are using the free, trial versions of JAWS and Window-Eyes they will require you to restart Windows after using either product for ~30 minutes. Using the virtual machine, you can revert back to using JAWS and Window-Eyes more quickly than you would if you had to restart Windows.

### Steps Summary

That's it. The steps for configuring your development environment for testing using a screen reader can be summarized as follows:

1.  Install virtualization software
2.  Install browsers & take a snapshot of that state
3.  Install and configure screen readers
4.  Restart the virtual machine & take a snapshot of that state

### Resources & Further Reader

-   [Developing Accessible Widgets with ARIA](/yuiblog/blog/2008/12/08/video-kloots-aria/)
-   [An Introduction to Screen Readers](http://video.yahoo.com/video/play?vid=514676)
-   [Roles for Accessible Rich Internet Applications (WAI-ARIA Roles) Version 1.0](http://www.w3.org/TR/aria-role/)
-   [States and Properties Module for Accessible Rich Internet Applications (WAI-ARIA States and Properties) Version 1.0](http://www.w3.org/TR/aria-state/)