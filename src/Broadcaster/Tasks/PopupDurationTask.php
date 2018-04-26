<?php

/*
 * Broadcaster (v1.4) by EvolSoft
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
    
    /** @var string */
    private $message;
    
    /** @var Player */
    private $player;
    
    /** @var int */
    private $duration;
	
    public function __construct(Broadcaster $plugin, $message, Player $player = null, $duration){
        parent::__construct($plugin);
    	$this->message = $message;
        $this->player = $player;
        $this->duration = $duration;
    }
    
    public function onRun(int $tick){
    	$plugin = $this->getOwner();
    	for($i = 0; $i < $this->duration * 10; $i++){
    	    if($this->player){
    	        $this->player->sendPopup($plugin->translateColors("&", $this->message));
    	    }else{
    	        $plugin->getServer()->broadcastPopup($plugin->translateColors("&", $this->message));
    	    }
    	}
    	$plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
    }
}