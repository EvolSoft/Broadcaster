<?php

/*
 * Broadcaster (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 13/01/2018 04:01 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */


namespace Broadcaster\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

use Broadcaster\Broadcaster;

class SendPopup extends PluginBase implements CommandExecutor {
	
	public function __construct(Broadcaster $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$this->temp = $this->plugin->getConfig()->getAll();
		if($sender->hasPermission("broadcaster.sendpopup")){
			if(isset($args[0]) && isset($args[1])){
				//Send message to all players
				if($args[0] == "*"){
				    $this->plugin->broadcast(null, Broadcaster::TYPE_POPUP, $sender->getName(), $this->plugin->getMessagefromArray($args));
				}else if($this->plugin->getServer()->getPlayerExact($args[0])){
				    $player = $this->plugin->getServer()->getPlayerExact($args[0]);
					$this->plugin->broadcast($player, Broadcaster::TYPE_POPUP, $sender->getName(), $this->plugin->getMessagefromArray($args));
				}else{
					$sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&cPlayer not found"));
				}
			}else{
				$sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&cUsage: /sp <player> <message>"));
			}
		}else{
			$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
		}
    	return true;
    }
}