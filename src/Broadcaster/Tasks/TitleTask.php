<?php

/*
 * Broadcaster (v1.3) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 01/02/2018 04:45 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\scheduler\PluginTask;

use Broadcaster\Broadcaster;

class TitleTask extends PluginTask {
    
    /** @var int */
    private $i;
    
    public function __construct(Broadcaster $plugin){
        parent::__construct($plugin);
        $this->i = 0;
    }
    
    public function onRun(int $currentTick){
        $plugin = $this->getOwner();
        $messages = $plugin->cfg["title-broadcast"]["messages"];
        back:
        if($this->i < count($messages)){
            $msg = explode("{SUBTITLE}", $messages[$this->i]);
            $plugin->getServer()->broadcastTitle($plugin->translateColors("&", $plugin->formatMessage($msg[0])), isset($msg[1]) ? $plugin->translateColors("&", $plugin->formatMessage($msg[1])) : "");
            $this->i++;
        }else{
            $this->i = 0;
            goto back;
        }
    }
}