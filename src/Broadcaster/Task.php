<?php

/*
 * Broadcaster (v1.15) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 01:48 PM (UTC)
 * Copyright & License: (C) 2014-2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class Task extends PluginTask{

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
		$this->length = -1;
    }

    public function onRun($currentTick){
    	$this->plugin = $this->getOwner();
    	$this->plugin->cfg = $this->plugin->getConfig()->getAll();
    	if($this->plugin->cfg["broadcast-enabled"]==true){
    		$this->length=$this->length+1;
    		$messages = $this->plugin->cfg["messages"];
    		$messagekey = $this->length;
    		$message = $messages[$messagekey];
    		if($this->length==count($messages)-1) $this->length = -1;
    		Server::getInstance()->broadcastMessage($this->plugin->translateColors("&", $this->plugin->broadcast($this->plugin->cfg, $message)));
    	}
    }

}
?>
