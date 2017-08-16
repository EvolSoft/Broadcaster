<?php

/*
 * Broadcaster (v1.16) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 28/05/2015 02:37 PM (UTC)
 * Copyright & License: (C) 2014-2017 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Commands;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use Broadcaster\Main;

class SendMessage extends PluginBase implements CommandExecutor{
	
	public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
    	switch(strtolower($cmd->getName())){
    			case "sendmessage":
    				$this->temp = $this->plugin->getConfig()->getAll();
    				if($sender->hasPermission("broadcaster.sendmessage")){
    					if(isset($args[0]) && isset($args[1])){
    						//Send message to all players
    						if($args[0] === "*"){
    							//Verify is $sender is Console or Player
    							if($sender instanceof CommandSender){
    								foreach($this->plugin->getServer()->getOnlinePlayers() as $onlineplayers){
    									$onlineplayers->sendMessage($this->plugin->translateColors("&", $this->plugin->messagebyConsole($sender, $this->temp, $this->plugin->getMessagefromArray($args))));
    								}
    							}elseif($sender instanceof Player){
    								foreach($this->plugin->getServer()->getOnlinePlayers() as $onlineplayers){
    									$onlineplayers->sendMessage($this->plugin->translateColors("&", $this->plugin->messagebyPlayer($sender, $this->temp, $this->plugin->getMessagefromArray($args))));
    								}
    							}	
    						}else{
    							//Verify if player exists
    							if($this->plugin->getServer()->getPlayerExact($args[0])){
    								$receiver = $this->plugin->getServer()->getPlayerExact($args[0]);
    								//Verify is $sender is Console or Player
    								if($sender instanceof CommandSender){
    									$receiver->sendMessage($this->plugin->translateColors("&", $this->plugin->messagebyConsole($sender, $this->temp, $this->plugin->getMessagefromArray($args))));
    								}elseif($sender instanceof Player){
    									$receiver->sendMessage($this->plugin->translateColors("&", $this->plugin->messagebyPlayer($sender, $this->temp, $this->plugin->getMessagefromArray($args))));
    								}
    							}else{
    								$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cPlayer not found"));
    							}
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cUsage: /sm <player> <message>"));
    					}
    				}else{
    					$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    					return true;
    				}
				break;
    		}
    	return true;
    }
    
}
    
