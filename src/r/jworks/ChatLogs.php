<?php

namespace r\jworks;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\plugin\PluginBase;

class ChatLogs extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChat(PlayerCommandPreprocessEvent $event)
    {
        if($event->isCancelled()) return;
        $today = date("Y-m-d");
        $name = $event->getPlayer()->getName();
        $file = fopen($this->getDataFolder() . "{$today}.txt", "w") or die("Unable to open file!");
        fwrite($file, "[{$today}] {$name} -> {$event->getMessage()}");
        fclose($file);
    }
}