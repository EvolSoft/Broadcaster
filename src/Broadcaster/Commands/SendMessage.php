<?php

/*
 * Broadcaster (v1.3) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 01/02/2018 01:06 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

use Broadcaster\Broadcaster;

class SendMessage extends PluginBase implements CommandExecutor {
    
    /** @var Broadcaster */
    private $plugin;
	
	public function __construct(Broadcaster $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		if($sender->hasPermission("broadcaster.sendmessage")){
			if(isset($args[0]) && isset($args[1])){
				if($args[0] == "*"){
				    $this->plugin->broadcast(Broadcaster::TYPE_MESSAGE, $sender->getName(), $this->plugin->getMessagefromArray($args));
				}else if(($player = $this->plugin->getServer()->getPlayerExact($args[0]))){
				    $this->plugin->broadcast(Broadcaster::TYPE_MESSAGE, $sender->getName(), $this->plugin->getMessagefromArray($args), $player);
				}else{
				    $sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&cPlayer not found"));
				}
			}else{
				$sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&cUsage: /sm <player> <message>"));
			}
		}else{
			$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
		}
    	return true;
    }
}