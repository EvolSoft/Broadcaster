<?php

/*
 * Broadcaster (v1.16) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 28/05/2015 02:46 PM (UTC)
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
use Broadcaster\Tasks\Task;
use Broadcaster\Tasks\PopupTask;
use Broadcaster\Tasks\Broadcaster\Tasks;

class Commands extends PluginBase implements CommandExecutor{
	
	public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
    	switch(strtolower($cmd->getName())){
    			case "broadcaster":
    				if(isset($args[0])){
    			   		$args[0] = strtolower($args[0]);
    			   		if($args[0] === "reload"){
    			   			if($sender->hasPermission("broadcaster.reload")) {
    			   				$this->plugin->reloadConfig();
    			   				$this->cfg = $this->plugin->getConfig()->getAll();
    			   				$time = intval($this->cfg["time"]) * 20;
    			   				$ptime = intval($this->cfg["popup-time"]) * 20;
    			   				$this->plugin->task->remove();
    			   				$this->plugin->ptask->remove();
    			   				$this->plugin->task = $this->plugin->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this->plugin), $time);
    			   				$this->plugin->ptask = $this->plugin->getServer()->getScheduler()->scheduleRepeatingTask(new PopupTask($this->plugin), $ptime);
    			   				$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aConfiguration Reloaded."));
    			   				return true;
    			   			}
    			   			else{
    			   				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    			   				return true;
    			   			}
    			   		}
    			   		elseif($args[0] === "info"){
    			   			if($sender->hasPermission("broadcaster.info")) {
    			   				$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2BroadCaster &9v" . Main::VERSION . " &2developed by&9 " . Main::PRODUCER));
    			   				$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2Website &9" . Main::MAIN_WEBSITE));
    			   				return true;
    			   			}
    			   			else{
    			   				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    			   				return true;
    			   			}
    			   		}else{
    			   			if($sender->hasPermission("broadcaster")){
    			   				$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cSubcommand &9" . $args[0] . "&c not found. Use &9/bc &cto show available commands"));
    			   				break;
    			   			}
    			   			else{
    			   				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    			   				break;
    			   			}
    			   			return true;
    			   		}
    			   	}
    			   	else{
    			   		if($sender->hasPermission("broadcaster")){
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&2- &9Available Commands &2-"));
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&9/bc info &2- &9Show info about this plugin"));
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&9/bc reload &2- &9Reload the config"));
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&9/sendmessage &2- &9Send message to the specified player (* for all players)"));
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&9/sendpopup &2- &9Send popup to the specified player (* for all players)"));
    			   			break;
    			   		}else{
    			   			$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    			   			break;
    			   			}
    			   		return true;
    			   	}
    		}
    	return true;
    }
    
}
    
