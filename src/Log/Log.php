<?php

namespace Log;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\event\Listener;

class Log extends PluginBase implements Listener{

public function onEnable(){
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	$this->getLogger()->info(TextFormat::AQUA."Logのロードが完了しました".TextFormat::RED."二次配布はおやめください".TextFormat::GREEN."by FUGAMARU");
}

public function onBreak(BlockBreakEvent $event){
	$x = $event->getBlock()->x;
	$y = $event->getBlock()->y;
	$z = $event->getBlock()->z;
	$id = $event->getBlock()->getID();

	$WorldName = $event->getPlayer()->getLevel()->getName();

	$Player = $event->getPlayer();
	$PlayerName = $Player->getName();

	$this->getLogger()->info(TextFormat::BLUE.$PlayerName.TextFormat::AQUA." さんがブロックを破壊しました-> ".TextFormat::GOLD."ID：".TextFormat::WHITE.$id.TextFormat::GOLD." ワールド名： ".TextFormat::WHITE.$WorldName.TextFormat::GOLD." 座標： x=".TextFormat::WHITE.$x.TextFormat::GOLD." y=".TextFormat::WHITE.$y.TextFormat::GOLD." z=".TextFormat::WHITE.$z);

}

public function onPlace(BlockPlaceEvent $event){
	$x = $event->getBlock()->x;
	$y = $event->getBlock()->y;
	$z = $event->getBlock()->z;
	$id = $event->getBlock()->getID();
	
	$WorldName = $event->getPlayer()->getLevel()->getName();

	$Player = $event->getPlayer();
	$PlayerName = $Player->getName();

	$this->getLogger()->info(TextFormat::BLUE.$PlayerName.TextFormat::AQUA." さんがブロックを設置しました-> ".TextFormat::GOLD."ID：".TextFormat::WHITE.$id.TextFormat::GOLD."  ワールド名：".TextFormat::WHITE.$WorldName.TextFormat::GOLD."  座標：x=".TextFormat::WHITE.$x.TextFormat::GOLD." y=".TextFormat::WHITE.$y.TextFormat::GOLD." z=".TextFormat::WHITE.$z);
}

public function onCommand(CommandSender $sender, Command $command, $label, array $args){ 
	switch($command->getName()){
		case "l":
		if (!$sender instanceof Player) return $sender->sendMessage(TextFormat::RED."lコマンドはゲーム内で実行してください");

			$x = $sender->getX();
			$y = $sender->getY();
			$z = $sender->getZ();

			$sender->getPlayer()->sendMessage("現在地： x=".$x." y=".$y." z=".$z);
		break;
	}
}
}

