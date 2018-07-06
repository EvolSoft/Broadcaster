<?php

/*
 * Broadcaster v1.5 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2014-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/Broadcaster/blob/master/LICENSE)
 */

namespace Broadcaster;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskHandler;
use pocketmine\utils\TextFormat;

class Broadcaster extends PluginBase {

    /** @var string */
	const PREFIX = "&9[&eBroadcaster&9] ";
	
	/** @var string */
	const API_VERSION = "2.0";
	
	/** @var int */
	const TYPE_MESSAGE = 0;
	
	/** @var int */
	const TYPE_POPUP = 1;
	
	/** @var int */
	const TYPE_TITLE = 2;
    
    /** @var TaskHandler */
    private $mtask;
    
    /** @var TaskHandler */
    private $ptask;
    
    /** @var TaskHandler */
    private $ttask;
    
    /** @var array */
    public $cfg;
    
    /** @var Broadcaster */
    private static $instance = null;
    
    public function onLoad(){
        if(!self::$instance instanceof Broadcaster){
            self::$instance = $this;
        }
    }
    
    public function onEnable(){
	    @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
        $this->getCommand("broadcaster")->setExecutor(new Commands\Commands($this));
        $this->getCommand("sendmessage")->setExecutor(new Commands\SendMessage($this));
        $this->getCommand("sendpopup")->setExecutor(new Commands\SendPopup($this));
        $this->getCommand("sendtitle")->setExecutor(new Commands\SendTitle($this));
        $this->initTasks();
    }
    
    /**
     * Replace variables inside a string
     *
     * @param string $str
     * @param array $vars
     *
     * @return string
     */
    public function replaceVars($str, array $vars){
        foreach($vars as $key => $value){
            $str = str_replace("{" . $key . "}", $value, $str);
        }
        return $str;
    }
    
    /**
     * Get Broadcaster API
     *
     * @return Broadcaster
     */
    public static function getAPI(){
        return self::$instance;
    }
    
    /**
     * Get Broadcaster version
     *
     * @return string
     */
    public function getVersion(){
        return $this->getDescription()->getVersion();
    }
    
    /**
     * Get Broadcaster API version
     *
     * @return string
     */
    public function getAPIVersion(){
        return self::API_VERSION;
    }
    
    /**
     * Reload Broadcaster configuration
     */
    public function reload(){
        $this->reloadConfig();
        $this->cfg = $this->getConfig()->getAll();
        $this->mtask->remove();
        $this->ptask->remove();
        $this->ttask->remove();
        $this->initTasks();
    }
    
    /**
     * Initialize Broadcaster tasks
     */
    public function initTasks(){
        if($this->cfg["message-broadcast"]["enabled"]){
            $mtime = intval($this->cfg["message-broadcast"]["time"]) * 20;
            $this->mtask = $this->getScheduler()->scheduleRepeatingTask(new Tasks\MessageTask($this), $mtime);
        }
        if($this->cfg["popup-broadcast"]["enabled"]){
            $ptime = intval($this->cfg["popup-broadcast"]["time"]) * 20;
            $this->ptask = $this->getScheduler()->scheduleRepeatingTask(new Tasks\PopupTask($this), $ptime);
        }
        if($this->cfg["title-broadcast"]["enabled"]){
            $ttime = intval($this->cfg["title-broadcast"]["time"]) * 20;
            $this->ttask = $this->getScheduler()->scheduleRepeatingTask(new Tasks\TitleTask($this), $ttime);
        }
    }
    
    /**
     * Format Broadcaster message
     * 
     * @param string $message
     * 
     * @return string
     */
    public function formatMessage($message){
        return $this->replaceVars($message, array(
            "MAXPLAYERS" => $this->getServer()->getMaxPlayers(),
            "TOTALPLAYERS" => count($this->getServer()->getOnlinePlayers()),
            "PREFIX" => $this->cfg["prefix"],
            "SUFFIX" => $this->cfg["suffix"],
            "TIME" => date($this->cfg["datetime-format"])
        ));
    }
    
    /**
     * Broadcast message, popup or title
     * 
     * @param int $type
     * @param string $sender
     * @param string $message
     * @param Player $recipient
     */
    public function broadcast(int $type, $sender, $message, Player $recipient = null){
        switch($type){
            default:
            case self::TYPE_MESSAGE:
                $format = $this->cfg["message-broadcast"]["command-format"];
                break;
            case self::TYPE_POPUP:
                $format = $this->cfg["popup-broadcast"]["command-format"];
                break;
            case self::TYPE_TITLE:
                $format = $this->cfg["title-broadcast"]["command-format"];
                break;
        }
        $array = array(
            "MAXPLAYERS" => $this->getServer()->getMaxPlayers(),
            "TOTALPLAYERS" => count($this->getServer()->getOnlinePlayers()),
            "PREFIX" => $this->cfg["prefix"],
            "SUFFIX" => $this->cfg["suffix"],
            "TIME" => date($this->cfg["datetime-format"]),
            "SENDER" => $sender,
            "MESSAGE" => $message
        );
        if($recipient){
            $array["PLAYER"] = $recipient->getName();
        }
        $msg = $this->replaceVars($format, $array);
        switch($type){
            default:
            case self::TYPE_MESSAGE:
                if($recipient){
                    $recipient->sendMessage(TextFormat::colorize($msg));
                    return;
                }
                foreach($this->getServer()->getOnlinePlayers() as $player){
                    $player->sendMessage(TextFormat::colorize(str_replace("{PLAYER}", $player->getName(), $msg)));
                }
                return;
            case self::TYPE_POPUP:
                $this->getServer()->getScheduler()->scheduleTask(new Tasks\PopupDurationTask($this, $msg, $recipient, $this->cfg["popup-broadcast"]["duration"]));
                return;
            case self::TYPE_TITLE:
                if($recipient){
                    $msg = explode("{SUBTITLE}", $msg);
                    $recipient->addTitle(TextFormat::colorize($msg[0]), isset($msg[1]) ? TextFormat::colorize($msg[1]) : "");
                    return;
                }
                foreach($this->getServer()->getOnlinePlayers() as $player){
                    $out = str_replace("{PLAYER}", $player->getName(), $msg);
                    $out = explode("{SUBTITLE}", $out);
                    $player->addTitle(TextFormat::colorize($out[0]), isset($out[1]) ? TextFormat::colorize($out[1]) : "");
                }
                return;
        }
    }
    
    /**
     * Join array elements with a string
     * 
     * @param array $array
     * 
     * @return string
     */
	public function getMessagefromArray($array){
		unset($array[0]);
		return implode(' ', $array);
	}
}