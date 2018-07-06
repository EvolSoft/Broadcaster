![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# Broadcaster

Advanced Broadcasting plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP API 3.0.0

## Overview

**Broadcaster** is an advanced Broadcasting plugin for PocketMine-MP.<br>
With Broadcaster you can set custom message, popup and title broadcasts. You can also send messages with /sm, popups with /sp and titles with /st commands.<br>
This plugin let you also customize colors (you can use the & sign instead of § for text format), prefixes, suffixes and intervals.

**EvolSoft Website:** https://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

## Donate

Please support the development of this plugin with a small donation by clicking [:dollar: here](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=flavius.c.1999@gmail.com&lc=US&item_name=www.evolsoft.tk&no_note=0&cn=&curency_code=EUR&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted). 
Your small donation will help me paying web hosting, domains, buying programs (such as IDEs, debuggers, etc...) and new hardware to improve software development. Thank you :smile:

## Documentation

**Configuration (config.yml):**

```yaml
---
# Available tags for broadcast messages, popups and titles:
# - {MAXPLAYERS}: Show the maximum number of players supported by the server
# - {TOTALPLAYERS}: Show the number of all online players
# - {PREFIX}: Show prefix
# - {SUFFIX}: Show suffix
# - {TIME}: Show current time
# Available tags for /sendmessage, /sendpopup and /sendtitle format:
# - {MESSAGE}: Show message
# - {MAXPLAYERS}: Show the maximum number of players supported by the server
# - {TOTALPLAYERS}: Show the number of all online players
# - {PREFIX}: Show prefix
# - {PLAYER}: Message receiver
# - {SENDER}: Show sender name
# - {SUFFIX}: Show suffix
# - {TIME}: Show current time
# Extra tag for titles:
# - {SUBTITLE}: Add subtitle (the text after this tag will be the content of the subtitle) 
# Prefix
prefix: "&9[&eBroadcaster&9]"
# Suffix
suffix: "[A]"
# Date\Time format (replaced in {TIME}). For format codes read http://php.net/manual/en/datetime.formats.php
datetime-format: "H:i:s"
# Message broadcast
message-broadcast:
 # Enable message broadcast
 enabled: true
 # Broadcast interval (in seconds)
 time: 15
 # Command /sendmessage format
 command-format: "&e[{TIME}] {PREFIX} {SUFFIX} &a{SENDER}&e>&f {MESSAGE}"
 # Broadcast messages
 messages:
  - "&e[{TIME}] {PREFIX}&f 1st message"
  - "&e[{TIME}] {PREFIX}&f 2nd message"
  - "&e[{TIME}] {PREFIX}&f 3rd message"
# Popup broadcast
popup-broadcast:
 # Enable popup broadcast
 enabled: true
 # Popup broadcast interval (in seconds)
 time: 15
 # Popup duration (in seconds)
 duration: 5
 # Command /sendpopup format
 command-format: "&a{SENDER}&e>>&f {MESSAGE}"
 # Popup broadcast messages
 messages:
  - "&aWelcome to your server"
  - "&d{TOTALPLAYERS} &eof &d{MAXPLAYERS} &eonline"
  - "&bCurrent Time: &a{TIME}"
# Title broadcast
title-broadcast:
 # Enable title broadcast
 enabled: true
 # Title broadcast interval
 time: 30
 # Command /sendtitle format
 command-format: "&d{MESSAGE}"
 # Title broadcast messages
 messages:
  - "&aWelcome to your server!{SUBTITLE}&bGood game!"
  - "&eHello player!"
...
```

**Commands:**

<dd><b><i>/broadcaster</b> - Broadcaster commands (aliases: [bc, broadcast])</i></dd>
<dd><i><b>/sendmessage &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send message to player(s) (aliases: [sm, smsg])</i></dd>
<dd><i><b>/sendpopup &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send popup to player(s) (aliases: [sp, spop])</i></dd>
<dd><i><b>/sendtitle &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send title to player(s) (aliases: [st, stl])</i></dd><br>

**Permissions:**

- <dd><i><b>broadcaster.*</b> - Broadcaster permissions tree.</i>
- <dd><i><b>broadcaster.info</b> - Let player read info about Broadcaster.</i>
- <dd><i><b>broadcaster.reload</b> - Let player reload Broadcaster.</i>
- <dd><i><b>broadcaster.sendmessage</b> - Let player send messages to players with /sendmessage command.</i>
- <dd><i><b>broadcaster.sendpopup</b> - Let player send popups to players with /sendpopup command.</i>
- <dd><i><b>broadcaster.sendpopup</b> - Let player send titles to players with /sendtitle command.</i>

## API

Almost all our plugins have API access to widely extend their features.

To access Broadcaster API:<br>
*1. Define the plugin dependency in plugin.yml (you can check if Broadcaster is installed in different ways):*

```yaml
depend: [Broadcaster]
```

*2. Include Broadcaster API in your plugin code:*

```php
//Broadcaster API
use Broadcaster\Broadcaster;
```

*3. Access the API by doing:*

```php
Broadcaster::getAPI()
```
