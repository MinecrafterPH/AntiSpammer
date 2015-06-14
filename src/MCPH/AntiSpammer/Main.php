<?php

namespace MCPH\AntiSpammer

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

	class Main extends PluginBase implements Listener{

	  private $last=[];

                public function translateColors($symbol, $message)
                {
    	           $message = str_replace($symbol."0", TextFormat::BLACK, $message);
    	           $message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
    	           $message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
    	           $message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
    	           $message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
    	           $message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
    	           $message = str_replace($symbol."6", TextFormat::GOLD, $message);
    	           $message = str_replace($symbol."7", TextFormat::GRAY, $message);
    	           $message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
    	           $message = str_replace($symbol."9", TextFormat::BLUE, $message);
    	           $message = str_replace($symbol."a", TextFormat::GREEN, $message);
    	           $message = str_replace($symbol."b", TextFormat::AQUA, $message);
    	           $message = str_replace($symbol."c", TextFormat::RED, $message);
    	           $message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
    	           $message = str_replace($symbol."e", TextFormat::YELLOW, $message);
    	           $message = str_replace($symbol."f", TextFormat::WHITE, $message);
    
    	           $message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
    	           $message = str_replace($symbol."l", TextFormat::BOLD, $message);
    	           $message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
    	           $message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
    	           $message = str_replace($symbol."o", TextFormat::ITALIC, $message);
    	           $message = str_replace($symbol."r", TextFormat::RESET, $message);
    	           return $message;
                }
                
		public function onEnable()
		{
			$this->getServer()->getPluginManager()->registerEvents($this,$this);
			$this->getLogger()->info("AntiSpammer has been enabled.");
			$cfg = $this->getConfig();
		}

		public function onDisable()
		{
			$this->getLogger()->info("AntiSpammer has been disabled.");
		}		
		
		public function onChat(PlayerChatEvent $event)
		{
		  $message = $cfg->get("kick-message")	
		  $player = $event->getPlayer();
		  $playerId = $player->getId(); // an identifier just for that player
		   if(isset($this->last[$playerId]) and microtime(true) - $this->last[$playerId] < 0.5){ // if this is not the first message the player chatted, and the last message was sent less than 0.5 second ago
		     $event->setCancelled();
		     $player->kick($message, false);
                     return;
                   }
                  $this->last[$playerId] = microtime(true); // save the current time as the time the player last chatted
                }
         }

?>  
