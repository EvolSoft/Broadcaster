<?php

/*
 * Broadcaster v1.5 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

use Broadcaster\Broadcaster;

class PopupDurationTask extends Task {
    
    /** @var Broadcaster */
    private $plugin;
    
    /** @var string */
    private $message;
    
    /** @var Player */
    private $player;
    
    /** @var int */
    private $duration;
	
    public function __construct(Broadcaster $plugin, $message, Player $player = null, $duration){
        $this->plugin = $plugin;
    	$this->message = $message;
        $this->player = $player;
        $this->duration = $duration;
    }
    
    public function onRun(int $tick){
    	for($i = 0; $i < $this->duration * 10; $i++){
    	    if($this->player){
    	        $this->player->sendPopup(TextFormat::colorize($this->message));
    	    }else{
    	        $this->plugin->getServer()->broadcastPopup(TextFormat::colorize($this->message));
    	    }
    	}
    	$this->getHandler()->cancel();
    }
}