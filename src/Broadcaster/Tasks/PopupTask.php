<?php

/*
 * Broadcaster v1.5 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Tasks;

use pocketmine\scheduler\Task;

use Broadcaster\Broadcaster;

class PopupTask extends Task {
    
    /** @var Broadcaster */
    private $plugin;
    
    /** @var int */
    private $i;
    
    public function __construct(Broadcaster $plugin){
        $this->plugin = $plugin;
        $this->i = 0;
    }
    
    public function onRun(int $currentTick){
        $messages = $this->plugin->cfg["popup-broadcast"]["messages"];
        back:
        if($this->i < count($messages)){
            $this->plugin->getScheduler()->scheduleTask(new PopupDurationTask($this->plugin, $this->plugin->formatMessage($messages[$this->i]), null, $this->plugin->cfg["popup-broadcast"]["duration"]));
            $this->i++;
        }else{
            $this->i = 0;
            goto back;
        }
    }
}