<?php

/*
 * Broadcaster (v1.16) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 28/05/2015 01:48 PM (UTC)
 * Copyright & License: (C) 2014-2017 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

use Broadcaster\Main;

class PopupDurationTask extends PluginTask {
	
    public function __construct(Main $plugin, $message, $player = null, $duration){
    	parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->player = $player;
        $this->message = $message;
        $this->duration = $duration;
        $this->current = 0;
    }
    
    public function onRun(int $tick){
    	$this->plugin = $this->getOwner();
    	if($this->current <= $this->duration){
    		if($this->player instanceof Player){
    			$this->message = str_replace("{PLAYER}", $this->player->getName(), $this->message);
    			$this->player->sendPopup($this->plugin->translateColors("&", $this->message));
    		}else{
    			foreach($this->plugin->getServer()->getOnlinePlayers() as $players){
    				$this->message = str_replace("{PLAYER}", "*", $this->message);
    				$players->sendPopup($this->plugin->translateColors("&", $this->message));
    			}
    		}
    	}else{
    		$this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
    	}
    	$this->current += 1;
    }
}

