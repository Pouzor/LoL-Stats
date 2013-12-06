<?php

namespace Pouzor\Bundle\LolStatBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{

	public function getCountStatsGlobal($id, $champName = null) {
		
		$stats = array();

		$stats["total"] = $this->getCountGameStats($id, $champName);
		$stats["invocateur"] = $this->getCountGameStats($id, $champName, "matchType", "CLASSIC");
		$stats["ranked"] = $this->getCountGameStats($id, $champName, "ranked", 1);
		$stats["aram"] = $this->getCountGameStats($id, $champName, "matchType", "ARAM");
		$stats["dominion"] = $this->getCountGameStats($id, $champName, "matchType", "DOMINION");
		$stats["3V3"] = "TODO";

        return $stats;
    }



    public function getCountGameStats($id, $champName = null, $criteria = null, $value = null) {
        $qBuilder = $this->getEntityManager()
        ->createQueryBuilder()
        ->from("PouzorLolStatBundle:Game", "g")
        ->select("COUNT(g.id) as nb, SUM(g.win) as win, COUNT(g.id)-SUM(g.win) as loose")
        ->where("g.idUser = :user")
        ->setParameter("user", $id);


        if ($criteria !== null) {
            $qBuilder->andWhere("g.$criteria = :value")
            ->setParameter("value", $value);  
        }

        if ($champName !== null) {
          $qBuilder->leftJoin("g.idChampion", "c")
          ->andWhere("c.name = :name")
          ->setParameter("name", $champName);  
        }

        return $qBuilder->getQuery()->getSingleResult();

    }

    public function getWinRatesQuery($id, $type, $ranked = "all") {
        $qBuilder = $this->getEntityManager()
        ->createQueryBuilder()
        ->from("PouzorLolStatBundle:Champion", "c")
        ->select('c.id, c.name, SUM(g.win) AS NB_WIN, COUNT(g.id) AS NB_GAME, (SUM(g.win)/COUNT(g.id))*100 AS RATE')
        ->leftJoin("c.games", "g")
        ->where("g.idUser = :user")
        ->andWhere("g.matchType = :type")

        ->setMaxResults(5)
        ->orderBy("RATE", "DESC")
        ->setParameter("user", $id)
        ->setParameter("type", $type)
        ->having("NB_GAME >= 5")
        ->addGroupBy("c.id");

        if ($ranked != "all")
            $qBuilder->andWhere("g.ranked = :ranked")->setParameter("ranked", $ranked);

        return $qBuilder->getQuery()->getResult();
    }


    public function getWinRates($id) {
        $rates = array();

        $rates["invoc"] = $this->getWinRatesQuery($id, "CLASSIC", "all");
        $rates["normal"] = $this->getWinRatesQuery($id, "CLASSIC", "0");
        $rates["ranked"] = $this->getWinRatesQuery($id, "CLASSIC", "1");
        $rates["aram"] = $this->getWinRatesQuery($id, "ARAM", "all");
        $rates["dominion"] = $this->getWinRatesQuery($id, "DOMINION", "all");


        return $rates;
    }


    public function getRecentGames($id, $champName = 0, $offset = 0, $filter = null, $order = 1) {
        $qBuilder = $this->getEntityManager()
        ->createQueryBuilder()
        ->from("PouzorLolStatBundle:Game", "g")
        ->select('g, c')
        ->leftJoin("g.idChampion", "c")
        ->orderBy("g.matchDate", "DESC")
        ->where("g.idUser = :user")
        ->setFirstResult($offset)
        ->setMaxResults(10)
        ->setParameter("user", $id)
        ;

        if ($champName !== 0) {
           $qBuilder->andWhere("c.name = :name")
           ->setParameter("name", $champName); 
        }

        if ($order == 1) {
            $qBuilder->orderBy("g.matchDate", "DESC");
        }    

        if ($order != 1) {
          $qBuilder->orderBy("g.$order", "DESC");  
          
      }

      if ($filter) {
        $filters = json_decode($filter, true);

        foreach ($filters as $f) {
            foreach ($f as $k => $v) {
                if ($v == "all")
                    continue;
                if ($k != "role") {
                    $qBuilder->andWhere("g.$k = :$k")
                    ->setParameter($k, $v);
                }
                else {
                    $qBuilder->andWhere("c.position = :$k")
                    ->setParameter($k, $v);
                }
            }
        }


    }


    return $qBuilder->getQuery()->getArrayResult();

}


}
