<?php

namespace r\jworks;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

class ChatLogs extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChat(PlayerChatEvent $event)
    {
        if($event->isCancelled())
            return;
        try{
            $today = date("Y-m-d");
            $name = $event->getPlayer()->getName();
            $file = fopen($this->getDataFolder() . "{$today}.txt", "a") or die("Unable to open file!");
            fwrite($file, "[{$today} " . date("h:i:sA") . "] {$name} -> {$event->getMessage()}\n");
            fclose($file);
        }catch(\Exception $e){
            $this->getServer()->getLogger()->warning($e->getMessage());
        }
    }
}