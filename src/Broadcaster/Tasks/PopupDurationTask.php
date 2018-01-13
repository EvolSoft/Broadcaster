<?php

/*
 * Broadcaster (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 13/01/2018 04:01 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

use Broadcaster\Broadcaster;

class PopupDurationTask extends PluginTask {
	
    public function __construct(Broadcaster $plugin, $message, Player $player = null, $duration){
        parent::__construct($plugin);
        $this->plugin = $plugin;
    	$this->message = $message;
        $this->player = $player;
        $this->duration = $duration;
    }
    
    public function onRun(int $tick){
    	$this->plugin = $this->getOwner();
    	for($i = 0; $i < $this->duration * 10; $i++){
    	    if($this->player){
    	        $this->player->sendPopup($this->plugin->translateColors("&", $this->message));
    	    }else{
    	        $this->plugin->getServer()->broadcastPopup($this->plugin->translateColors("&", $this->message));
    	    }
    	}
    	$this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
    }
}

