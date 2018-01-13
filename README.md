![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# Broadcaster

Advanced Broadcasting plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP 1.7dev API 3.0.0-ALPHA7, 3.0.0-ALPHA8, 3.0.0-ALPHA9, 3.0.0-ALPHA10

## Overview

**Broadcaster** is an advanced Broadcasting plugin for PocketMine-MP.

**EvolSoft Website:** https://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

With Broadcaster you can set custom message/popup and title broadcasts. You can also send messages with /sm, send popups with /sp and send titles with /st commands.<br>
You can also customize colors, prefixes, suffixes and intervals. You can use the & sign instead of §.

**Commands:**

<dd><i><b>/broadcaster</b> - Broadcaster commands</i></dd>
<dd><i><b>/sendmessage</b> - Send message to the specified player (* for all players)</i></dd>
<dd><i><b>/sendpopup</b> - Send popup to the specified player (* for all players)</i></dd>
<dd><i><b>/sendtitle</b> - Send title to the specified player (* for all players)</i></dd>
<br>

## Donate

Support the development of this plugin with a small donation by clicking [:dollar: here](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=flavius.c.1999@gmail.com&lc=US&item_name=www.evolsoft.tk&no_note=0&cn=&curency_code=EUR&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted). Thank you :smile:

## Documentation

**Configuration (config.yml):**

```yaml
---
#Available Tags (broadcast messages/popups):
# - {MAXPLAYERS}: Show the maximum number of players supported by the server
# - {TOTALPLAYERS}: Show the number of all online players
# - {PREFIX}: Show prefix
# - {SUFFIX}: Show suffix
# - {TIME}: Show current time
#Available Tags (sendmessage/sendpopup format):
# - {MESSAGE}: Show message
# - {MAXPLAYERS}: Show the maximum number of players supported by the server
# - {TOTALPLAYERS}: Show the number of all online players
# - {PREFIX}: Show prefix
# - {SENDER}: Show sender name
# - {SUFFIX}: Show suffix
# - {TIME}: Show current time
#Prefix
prefix: "Broadcaster"
#Suffix
suffix: "[A]"
#Broadcast interval (in seconds)
time: 15
#Command /sm output format
sendmessage-format: "&e[{TIME}] &b[{PREFIX}] {SUFFIX} &a{SENDER}&e>&f {MESSAGE}"
#Date\Time format (replaced in {TIME}). For format codes read http://php.net/manual/en/datetime.formats.php
datetime-format: "H:i:s"
#Enable auto broadcast
broadcast-enabled: true
#Broadcast messages (you can set as many as you want)
messages:
 - "&e[{TIME}] &b[{PREFIX}]&f 1st message"
 - "&e[{TIME}] &b[{PREFIX}]&f 2nd message"
 - "&e[{TIME}] &b[{PREFIX}]&f 3rd message"
#Popup broadcast interval (in seconds)
popup-time: 15
#Popup duration (in seconds)
popup-duration: 5
#Command /sp output format
sendpopup-format: "&a{SENDER}&e>>&f {MESSAGE}"
#Enable auto popup broadcast
popup-broadcast-enabled: true
popups:
 - "&aWelcome to your server"
 - "&d{TOTALPLAYERS} &eof &d{MAXPLAYERS} &eonline"
 - "&bCurrent Time: &a{TIME}"
```

**Commands:**

<dd><b><i>/broadcaster</b> - Broadcaster commands (aliases: [bc, broadcast])</i></dd>
<dd><i><b>/sendmessage &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send message to player(s) (aliases: [sm, smsg])</i></dd>
<dd><i><b>/sendpopup &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send popup to player(s) (aliases: [sp, spop])</i></dd>
<dd><i><b>/sendtitle &lt;player (* for all players)&gt; &lt;message&gt;</b> - Send title to player(s) (aliases: [st, stl])</i></dd>

**Permissions:**

- <dd><i><b>broadcaster.*</b> - Broadcaster permissions tree.</i>
- <dd><i><b>broadcaster.info</b> - Let player read info about Broadcaster.</i>
- <dd><i><b>broadcaster.reload</b> - Let player reload Broadcaster.</i>
- <dd><i><b>broadcaster.sendmessage</b> - Let player send messages to players with /sendmessage command.</i>
- <dd><i><b>broadcaster.sendpopup</b> - Let player send popups to players with /sendpopup command.</i>
- <dd><i><b>broadcaster.sendpopup</b> - Let player send titles to players with /sendtitle command.</i>
