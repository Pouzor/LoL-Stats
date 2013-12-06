<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;



class SummonerController extends Controller
{

	/**
	*
    * Show all stats about one Summoner
	* @Template()
	* @Route("/show/{id}", name="show_sommoner")
	*
	*/
	public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
		$summoner = $em->getRepository("PouzorLolStatBundle:User")->find($id);
		$stats = $em->getRepository("PouzorLolStatBundle:Game")->getCountStatsGlobal($id);
		$games = $em->getRepository("PouzorLolStatBundle:Game")->getRecentGames($id);

        $winRates = $em->getRepository("PouzorLolStatBundle:Game")->getWinRates($id);
        $champions = $em->getRepository("PouzorLolStatBundle:Champion")->findAllOrdered();

		return array(
            "summoner" => $summoner,
            "stats" => $stats,
            "winrates" => $winRates,
            "games" => $games, "id" => $id,
            "champions" => $champions
        );
	}



	/**
	*
    * Load more match history about a summoner
	* @Template()
	* @Route("/ajaxMoreGame", name="ajax_more_game")
	*
	*/
	public function ajaxMoreGameAction(Request $request) {

		$games = $this->getDoctrine()->getManager()
		->getRepository("PouzorLolStatBundle:Game")
		->getRecentGames($request->request->get("id"), $request->request->get("offset"), $request->request->get("filter"), $request->request->get("order", 1));

		return array("games" => $games);
	}

}
