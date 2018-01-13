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

class SendMessage extends PluginBase implements CommandExecutor {
	
	public function __construct(Broadcaster $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		if($sender->hasPermission("broadcaster.sendmessage")){
			if(isset($args[0]) && isset($args[1])){
				//Send message to all players
				if($args[0] == "*"){
					foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
					    $this->plugin->broadcast($player, Broadcaster::TYPE_MESSAGE, $sender->getName(), $this->plugin->getMessagefromArray($args));
					}
				}else if($this->plugin->getServer()->getPlayerExact($args[0])){
					$player = $this->plugin->getServer()->getPlayerExact($args[0]);
					$this->plugin->broadcast($player, Broadcaster::TYPE_MESSAGE, $sender->getName(), $this->plugin->getMessagefromArray($args));
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