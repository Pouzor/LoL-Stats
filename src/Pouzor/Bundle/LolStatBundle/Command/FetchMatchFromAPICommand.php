<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\Game;
use Pouzor\Bundle\LolStatBundle\Entity\Champion;

class FetchMatchFromAPICommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('pouzor:getMatch')
        ->setDescription('Get last 10 match for all user')

        ;
    }

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

        $summs = $em->getRepository("PouzorLolStatBundle:User")->findAll();

        $error = array();
        foreach ($summs as $summ)  {

            $tuData = $this->get("https://community-league-of-legends.p.mashape.com/api/v1.0/".$summ->getServer()."/summoner/getRecentGames/".$summ->getSummonersid());


            if (!$tuData) {
                die("Erreur connexion");
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

                $m->setIdUser($summ->getId());


                foreach ($g["statistics"]["array"] as $d) {
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
                      $m->setItem0($em->getReference("PouzorLolStatBundle:Item", $d["value"]));
                      break;
                      case "ITEM1":
                      $m->setItem1($d["value"]);//TODO
                      break;
                      case "ITEM2":
                      $m->setItem2($d["value"]);
                      break;
                      case "ITEM3":
                      $m->setItem3($d["value"]);
                      break;
                      case "ITEM4":
                      $m->setItem4($d["value"]);
                      break;
                      case "ITEM5":
                      $m->setItem5($d["value"]);
                      break;
                      case "ITEM6":
                      $m->setItem6($d["value"]);
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

              $em->persist($m);
              $em->flush();


          }
          $output->writeln(date("H:i d-m-Y")." - Ajout de $nb match pour ".$summ->getName());


      }



  }


}
