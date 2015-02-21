![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# Broadcaster

Advanced Broadcasting plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.9.0

## Overview

**Broadcaster** is an Advanced Broadcasting plugin.

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

You can set custom automatic messages and you can also send messages with /sm command.<br>
You can also customize prefix, suffix and interval. (read documentation)

**Commands:**

<dd><i><b>/broadcaster</b> - Broadcaster commands</i></dd>
<dd><i><b>/sendmessage</b> - Send message to specified player (* for all players)</i></dd>
<br>
**To-Do:**
<br><br>
*- Bug fix (if bugs will be found)*

## Documentation

**Colors:**

Black ("&0");<br>
Dark Blue ("&1");<br>
Dark Green ("&2");<br>
Dark Aqua ("&3");<br>
Dark Red ("&4");<br>
Dark Purple ("&5");<br>
Gold ("&6");<br>
Gray ("&7");<br>
Dark Gray ("&8");<br>
Blue ("&9");<br>
Green ("&a");<br>
Aqua ("&b");<br>
Red ("&c");<br>
Light Purple ("&d");<br>
Yellow ("&e");<br>
White ("&f");<br>

**Special:**

Obfuscated ("&k");<br>
Bold ("&l");<br>
Strikethrough ("&m");<br>
Underline ("&n");<br>
Italic ("&o");<br>
Reset ("&r");<br>

**Configuration (config.yml):**

```yaml
---
#Available Tags (broadcast messages):
# - {PREFIX}: Show prefix
# - {SUFFIX}: Show suffix
# - {TIME}: Show current time
#Available Tags (sendmessage format):
# - {MESSAGE}: Show message
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
sendmessage-format: "[{TIME}] [{PREFIX}] {SUFFIX} {SENDER}> {MESSAGE}"
#Date\Time format (replaced in {TIME}). For format codes read http://php.net/manual/en/datetime.formats.php
datetime-format: "H:i:s"
#Enable auto broadcast
broadcast-enabled: true
#Broadcast messages (you can set as many as you want)
messages:
- "[{TIME}] [{PREFIX}] 1st message"
- "[{TIME}] [{PREFIX}] 2nd message"
- "[{TIME}] [{PREFIX}] 3rd message"
...
```

**Commands:**

<dd><b><i>/broadcaster</b> - Broadcaster commands (aliases: [bc, broadcast])</i></dd>
<dd><i><b>/sendmessage &lt;to player (* for all players)&gt; &lt;message&gt;</b> - Send message to player (aliases: [sm, smsg])</i></dd>
<br>
**Permissions:**
<br><br>
- <dd><i><b>broadcaster.*</b> - Broadcaster commands permissions.</i>
- <dd><i><b>broadcaster.info</b> - Allows player to read info about Broadcaster.</i>
- <dd><i><b>broadcaster.reload</b> - Allows player to reload Broadcaster.</i>
- <dd><i><b>broadcaster.sendmessage</b> - Allows sending messages to players with /sendmessage command.</i>
