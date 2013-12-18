<?php

namespace Pouzor\Bundle\LolStatBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends EntityRepository
{
    public function getStatsForChampAndSumm($userId, $champName) {
        $qBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->from("PouzorLolStatBundle:Item", "i")
            ->select('i as item', "g", "c", "COUNT(i.id) as nb", "(SUM(g.win)/COUNT(g.id))*100 AS rate")
            //->setMaxResults(20)
            ->leftJoin("i.games", "g")
            ->leftJoin("g.idChampion", "c")
            ->where("c.name = :name")
            ->andWhere("g.idUser = :user")
            ->groupBy("i.id")
            ->orderBy("nb", "DESC")
            ->addOrderBy("rate", "DESC")
            ->setParameter("user", $userId)
            ->setParameter("name", $champName)
        ;


        return $qBuilder->getQuery()->getArrayResult();
    }

}
