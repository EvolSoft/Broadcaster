<?php

/*
 * Broadcaster (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 13/02/2018 06:57 PM (UTC)
 * Copyright & License: (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

use Broadcaster\Broadcaster;

class Commands extends PluginBase implements CommandExecutor {
    
    /** @var Broadcaster */
    private $plugin;
    
    /** @var int */
    private $lstchk = 0;
	
	public function __construct(Broadcaster $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    	if(isset($args[0])){
	   		$args[0] = strtolower($args[0]);
	   		switch($args[0]){
	   		    case "info":
	   		        if($sender->hasPermission("broadcaster.info")){
	   		            $sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&2Broadcaster &9v" . $this->plugin->getDescription()->getVersion() . "&2 developed by &9EvolSoft"));
	   		            $sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&2Website &9" . $this->plugin->getDescription()->getWebsite()));
	   		            break;
	   		        }
	   		        $sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
	   		        break;
	   		    case "help":
	   		        goto help;
	   		    case "reload":
	   		        if($sender->hasPermission("broadcaster.reload")){
	   		            $this->plugin->reload();
	   		            $sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&aConfiguration reloaded"));
	   		            break;
	   		        }
	   		        $sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
	   		        break;
	   		    default:
	   		        if($sender->hasPermission("broadcaster")){
	   		            $sender->sendMessage($this->plugin->translateColors("&", Broadcaster::PREFIX . "&cSubcommand &9" . $args[0] . "&c not found. Use &9/bc &cto show available commands"));
	   		            break;
	   		        }
	   		        $sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
	   		        break;
	   		}
	   		return true;
	   	}
	   	help:
        if($sender->hasPermission("broadcaster")){
            $sender->sendMessage($this->plugin->translateColors("&", "&2- &9Available Commands &2-"));
       		$sender->sendMessage($this->plugin->translateColors("&", "&9/bc info &2- &9Show info about this plugin"));
       		$sender->sendMessage($this->plugin->translateColors("&", "&9/bc reload &2- &9Reload the config"));
       		$sender->sendMessage($this->plugin->translateColors("&", "&9/sendmessage &2- &9Send message to the specified player (* for all players)"));
       		$sender->sendMessage($this->plugin->translateColors("&", "&9/sendpopup &2- &9Send popup to the specified player (* for all players)"));
       		$sender->sendMessage($this->plugin->translateColors("&", "&9/sendtitle &2- &9Send title to the specified player (* for all players)"));
       	}else{
       		$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
       	}
    	return true;
    }
}