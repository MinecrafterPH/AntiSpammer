<?php

namespace MCPH\AntiSpammer

use pocketmine\Player;
use pocketmine\server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

	class Main extends PluginBase implements Listener{

	  private $last=[];
	  
		public function onEnable()
		{
			$this->getServer()->getPluginManager()->registerEvents($this,$this);
			$this->getLogger()->info("AntiSpammer has been enabled.");
		}

		public function onDisable()
		{
			$this->getLogger()->info("AntiSpammer has been disabled.");
		}		
		
		public function onChat(PlayerChatEvent $event)
		{
		  $player = $event->getPlayer();
		  $playerId = $player->getId(); // an identifier just for that player
		  if(isset($this->last[$playerId]) andmicrotime(true)-$this->last[$playerId] < 0.5){ // if this is not the first message the player chatted, and the last message was sent less than 0.5 second ago
		    $event->setCancelled();
		    $player->kick();
        return;
      }
      $this->last[$playerId] = microtime(true); // save the current time as the time the player last chatted
    }
  }

?>  
