<?php

/*
 * Broadcaster (v1.16) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 28/05/2015 01:31 PM (UTC)
 * Copyright & License: (C) 2014-2017 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

use Broadcaster\Main;

class Task extends PluginTask {

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
		$this->length = -1;
    }

    public function onRun(int $currentTick){
    	$this->plugin = $this->getOwner();
    	$this->cfg = $this->plugin->getConfig()->getAll();
    	if($this->cfg["broadcast-enabled"] === true){
    		$this->length = $this->length+1;
    		$messages = $this->cfg["messages"];
    		$messagekey = $this->length;
    		$message = $messages[$messagekey];
    		if($this->length === count($messages)-1) $this->length = -1;
    		Server::getInstance()->broadcastMessage($this->plugin->translateColors("&", $this->plugin->broadcast($this->cfg, $message)));
    	}
    }

}

