<?php

namespace Pouzor\Bundle\LolStatBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRankRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRankRepository extends EntityRepository
{
    public function getByUser($id) {
        $qBuilder = $this->getEntityManager()
        ->createQueryBuilder()
        ->from("PouzorLolStatBundle:UserRank", "r")
        ->select("r.rankDate, MAX(r.score) as max_score")
        ->leftJoin("r.idUser", "u")
        ->where("u.id = :user")
        ->orderBy("r.id", "DESC")
       // ->groupBy("r.rankDate")
        ->setParameter("user", $id);

        $datas = $qBuilder->getQuery()->getArrayResult();

        $results = array();

        foreach ($datas as $d) {
           $results[] = array("date" => $d["rankDate"]->format("Y-m-d"), "lps" => $d["max_score"]); 
        }

        return $results;
    }
}
