<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ChampionController extends Controller
{
	/**
	*
    * Show all stats about a champion for a Summoner
	* @Template()
	* @Route("/show/{userId}/champion/{champName}", name="show_sommoner_champion")
    * @Method({"GET"})
	*
	*/
	public function showSummonerAction($userId, $champName) {

        $em = $this->getDoctrine()->getManager();
       	$summoner = $em->getRepository("PouzorLolStatBundle:User")->find($userId);
		$games = $em->getRepository("PouzorLolStatBundle:Game")->getRecentGames($userId, $champName);
		$stats = $em->getRepository("PouzorLolStatBundle:Game")->getCountStatsGlobal($userId, $champName);

		$items = $em->getRepository("PouzorLolStatBundle:Item")->getStatsForChampAndSumm($userId, $champName);



		return array(
			"games" => $games,
			"summoner" => $summoner,
			"champName" => $champName,
			"stats" => $stats,
            "items" => $items);
	}
}
