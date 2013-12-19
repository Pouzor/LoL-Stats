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
		$filter = array("matchType" => "CLASSIC");
		$items = $em->getRepository("PouzorLolStatBundle:Item")->getStatsForChampAndSumm($userId, $champName, 0, array($filter));



		return array(
			"games" => $games,
			"summoner" => $summoner,
			"champName" => $champName,
			"stats" => $stats,
			"items" => $items);
	}


	/**
	*
	* @Template()
	* @Route("/ajaxMoreGame", name="ajax_more_item")
    * @Method({"GET", "POST"})
	*
	*/
	public function ajaxMoreItemAction() {
		$em = $this->getDoctrine()->getManager();
		$items = $em->getRepository("PouzorLolStatBundle:Item")->getStatsForChampAndSumm($userId, $champName, $request->request->get("offset"), array());

		return array("items" => $items);
	}

}
