<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\Game;
use Pouzor\Bundle\LolStatBundle\Entity\UserRank;
use Pouzor\Bundle\LolStatBundle\Entity\Champion;
use Pouzor\Bundle\LolStatBundle\Entity\Item;

class FetchMatchFromAPICommand extends ContainerAwareCommand
{
  protected function configure()
  {
    $this
    ->setName('pouzor:getMatch')
    ->setDescription('Get last 10 match for all user')

    ;
}

/**
 * @param string $url
 */
private function get($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
        $header = array("X-Mashape-Authorization: ".$this->getContainer()->getParameter('mashape_key'));//Mashable
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $leagues = array(
                         "BRONZE" => 1000,
                         "SILVER" => 2000,
                         "GOLD" => 3000,
                         "PLATINUM" => 4000,
                         "DIAMOND" => 5000
                         );

        $divisions = array(
                         "I" => 500,
                         "II" => 400,
                         "III" => 300,
                         "IV" => 200,
                         "V" => 100
                         );

        $summs = $em->getRepository("PouzorLolStatBundle:User")->findAll();

        $error = array();
        foreach ($summs as $summ)  {

            //TODO REMPLACE API SERVICE
            $tuData = $this->get("https://community-league-of-legends.p.mashape.com/api/v1.0/".$summ->getServer()."/summoner/getRecentGames/".$summ->getAccountid());


            if (!$tuData) {
                $output->writeln("Erreur connexion");
                return;
            }

            $data = json_decode($tuData, true);


            if (!isset($data["gameStatistics"])) {
                $error[$summ->getName()]  = $tuData;
                continue;
            }


            $data = $data["gameStatistics"]["array"];
            $nb = 0;

            if (!is_array($data)) {
                $error[$summ->getName()]  = $tuData;
                continue;
            }

            $ranked = false;
            foreach ($data as $g) {
                $q = $em->getRepository("PouzorLolStatBundle:Game")->findOneBy(array("idMatch" => $g["gameId"], "idUser" => $summ->getId()));

                if ($q)
                    continue;

                $nb++;

                $m = new Game();


                $c = $em->getRepository("PouzorLolStatBundle:Champion")->find($g["championId"]);

                if (!$c) {
                    $c = new Champion();

                    $c->setName($g["skinName"] ? $g["skinName"] : "todo name");
                    $c->setId($g["championId"]);
                    $em->persist($c);

                    $metadata = $em->getClassMetaData(get_class($c));
                    $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                }


                $m->setIdMatch($g["gameId"]);
                $m->setIdChampion($c);
                $m->setMatchType($g["gameMode"]);
                $m->setPremadeSize($g["premadeSize"]);
                $m->setIpEarned($g["ipEarned"]);
                $m->setMatchDate(strtotime($g["createDate"]));
                $m->setDateFormat(new \DateTime(date("Y-m-d", $m->getMatchDate())));


                $m->setIdUser($summ);


                foreach ($g["statistics"]["array"] as $d) {
                //DEBUG
                //$output->writeln($d["statType"]." - ".$d["value"]);
                    switch ($d["statType"]) {
                        case "BARRACKS_KILLED":
                        break;
                        case "NEUTRAL_MINIONS_KILLED_ENEMY_JUNGLE":
                        break;
                        case "TOTAL_HEAL":
                        break;
                        case "WARD_KILLED":
                        break;
                        case "MAGIC_DAMAGE_DEALT_PLAYER":
                        break;
                        case "TOTAL_DAMAGE_TAKEN":
                        $m->setTotalDamageTaken($d["value"]);
                        break;
                        case "MAGIC_DAMAGE_DEALT_TO_CHAMPIONS":
                        break;
                        case "TRUE_DAMAGE_DEALT_TO_CHAMPIONS":
                        break;
                        case "LARGEST_KILLING_SPREE":
                        break;
                        case "VISION_WARDS_BOUGHT_IN_GAME":
                        break;
                        case "PHYSICAL_DAMAGE_DEALT_PLAYER":
                        break;
                        case "LARGEST_MULTI_KILL":
                        break;
                        case "TOTAL_DAMAGE_DEALT":
                        break;
                        case "TOTAL_TIME_CROWD_CONTROL_DEALT":
                        break;
                        case "TRUE_DAMAGE_TAKEN":
                        break;
                        case "ITEM0":
                        case "ITEM1":
                        case "ITEM2":
                        case "ITEM3":
                        case "ITEM4":
                        case "ITEM5":
                        case "ITEM6":
                        if (!$d["value"])
                            break;
                        $item = $em->getRepository("PouzorLolStatBundle:Item")->find($d["value"]);

                        if (!$item) {
                            $item = new Item();
                            $item->setName("TODO");
                            $item->setId($d["value"]);
                            $item->setGroups("TODO");
                            $item->setDescription("TODO");
                            $item->setPlaintext("TODO");
                            $item->setTotalCost(0);
                            $em->persist($item);
                            $metadata = $em->getClassMetaData(get_class($item));
                            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                        }
                        $m->addItem($item);
                        break;
                        case "PHYSICAL_DAMAGE_DEALT_TO_CHAMPIONS":
                        break;
                        case "SIGHT_WARDS_BOUGHT_IN_GAME":
                        break;
                        case "WIN":
                        $m->setWin(1);
                        break;
                        case "LOSE":
                        $m->setWin(0);
                        break;
                        case "NEUTRAL_MINIONS_KILLED_YOUR_JUNGLE":
                        break;
                        case "TOTAL_DAMAGE_DEALT_TO_CHAMPIONS":
                        $m->setDamageToChampion($d["value"]);
                        break;
                        case "MAGIC_DAMAGE_TAKEN":
                        break;
                        case "TOTAL_TIME_SPENT_DEAD":
                        $m->setTimeDead($d["value"]);
                        break;
                        case "WARD_PLACED":
                        break;
                        case "LEVEL":
                        break;
                        case "TRUE_DAMAGE_DEALT_PLAYER":
                        break;
                        case "ASSISTS":
                        $m->setAssist($d["value"]);
                        break;
                        case "CHAMPIONS_KILLED":
                        $m->setKilled($d["value"]);
                        break;
                        case "NUM_DEATHS":
                        $m->setDeath($d["value"]);
                        break;
                        case "NEUTRAL_MINIONS_KILLED":
                        break;
                        case "MINIONS_KILLED":
                        $m->setMinionsKilled($d["value"]);
                        break;
                        case "TURRETS_KILLED":
                        $m->setTurretsKilled($d["value"]);
                        break;
                        case "GOLD_EARNED":
                        $m->setGold($d["value"]);
                        break;
                        case "PHYSICAL_DAMAGE_TAKEN":
                        break;
                        case "LARGEST_CRITICAL_STRIKE":
                        break;

                    }

                }

                $m->setRanked($g["ranked"]);

                if ($g["ranked"])
                    $ranked = true;

                //TODO to moove out for
                try {
                    $em->persist($m);
                    $em->flush();
                }
                catch (\Exception $e) {

                    $output->writeln("Error for ".$summ->getName());
                    $output->writeln($e->getMessage());
                }

            }//END FOREACH MATCH

            if ($ranked) {
                $output->writeln("Change rank for for ".$summ->getName());
                $data2 = $this->get("https://community-league-of-legends.p.mashape.com/api/v1.0/".$summ->getServer()."/summoner/getLeagueForPlayer/".$summ->getSummonersid());

                $data2 = json_decode($data2, true);

                $stats = "";

                foreach ($data2["entries"] as $entries) {
                    foreach ($entries as $entrie) {
                    if ($entrie["playerOrTeamName"] == $summ->getName()) {
                        $stats = $entrie;
                        break;
                    }
                }
                }

                if ($stats != "") {

                    $r = new UserRank();

                    $r->setPoints($stats["leaguePoints"]);
                    $r->setRankDate(new \DateTime(date("Y-m-d")));
                    $r->setIdUser($summ);
                    $r->setLeague($leagues[$data2["tier"]]);
                    $r->setDivision($divisions[$data2["requestorsRank"]]);
                    $r->setScore($leagues[$data2["tier"]] + $divisions[$data2["requestorsRank"]] + $stats["leaguePoints"]);
                    $em->persist($r);

                    $summ->setPoints($stats["leaguePoints"]);
                    $summ->setLeague($leagues[$data2["tier"]]);
                    $summ->setDivision($divisions[$data2["requestorsRank"]]);

                    $em->flush();
                }
            }

            $output->writeln(date("H:i d-m-Y")." - Ajout de $nb match pour ".$summ->getName());


        }//END FOREACH PLAYER



    }


}
