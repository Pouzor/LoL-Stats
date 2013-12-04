<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Pouzor\Bundle\LolStatBundle\Repository\GameRepository;

class SummonerController extends Controller
{

	/**
	*
	* @Template()
	* @Route("/show/{id}", name="show_sommoner")
	*
	*/
	public function showAction($id) {

		$summoner = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:User")->find($id);
		$stats = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getCountStatsGlobal($id);
		$games = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getRecentGames($id);
		

        $winRates = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getWinRates($id);



		return array("summoner" => $summoner, "stats" => $stats, "winrates" => $winRates, "games" => $games, "id" => $id);
	}



	/**
	*
	* @Template()
	* @Route("/ajaxMoreGame", name="ajax_more_game")
	*
	*/
	public function ajaxMoreGameAction(Request $request) {
		$games = $this->getDoctrine()->getManager()
		->getRepository("PouzorLolStatBundle:Game")
		->getRecentGames($request->request->get("id"), $request->request->get("time"));

		return array("games" => $games);	
	}

}
