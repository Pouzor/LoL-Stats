<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Pouzor\Bundle\LolStatBundle\Entity\User;



class SummonerController extends Controller
{

	/**
	*
    * Show all stats about one Summoner
	* @Template()
	* @Route("/show/{id}", name="show_summoner")
    * @Method({"GET"})
	*
	*/
	public function showAction($id, User $summoner) {
        $em = $this->getDoctrine()->getManager();
		//$summoner = $em->getRepository("PouzorLolStatBundle:User")->find($id);
        $stats = $em->getRepository("PouzorLolStatBundle:Game")->getCountStatsGlobal($summoner);
        $games = $em->getRepository("PouzorLolStatBundle:Game")->getRecentGames($summoner);

        $winRates = $em->getRepository("PouzorLolStatBundle:Game")->getWinRates($summoner);
        $champions = $em->getRepository("PouzorLolStatBundle:Champion")->findAllOrdered();

        $lps = $em->getRepository("PouzorLolStatBundle:UserRank")->getByUser($summoner);

        return array(
                     "summoner" => $summoner,
                     "stats" => $stats,
                     "winrates" => $winRates,
                     "lps" => json_encode($lps, 1),
                     "games" => $games,
                     "champions" => $champions
                     );
    }



	/**
	*
    * Load more match history about a summoner
	* @Template()
	* @Route("/ajaxMoreGame", name="ajax_more_game")
    * @Method({"GET"})
	*/
	public function ajaxMoreGameAction(Request $request) {

		$games = $this->getDoctrine()->getManager()
		->getRepository("PouzorLolStatBundle:Game")
		->getRecentGames($request->query->get("id"), 0, $request->query->get("offset"), $request->query->get("filter"), $request->query->get("order", 1));

		return array("games" => $games);
	}


    /**
    *
    * Get champions stats for a summoner
    * @Template()
    * @Route("/showSummonerChampions/{id}", name="show_summoner_champions")
    * @Method({"GET"})
    */
    public function showSummonerChampionsAction(Request $request, User $summoner) {

        $champions = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Champion")
        ->getFilter($summoner, "nb_match");

        return array("champions" => $champions, "summoner" => $summoner);
    }


    /**
    * Ajax filter for champ view
    * @Template()
    * @Route("/ajaxFilterChampion", name="ajax_filter_champion")
    * @Method({"GET"})
    */
    public function ajaxFilterChampionAction(Request $request) {

        $summoner = $this->getDoctrine()->getRepository("PouzorLolStatBundle:User")->find($request->query->get("id"));

        $champions = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Champion")
        ->getFilter($summoner, $request->query->get("sorting"), $request->query->get("type"));


        return array("champions" => $champions, "summoner" => $summoner);
    }

    /**
    * Match History
    * @Template()
    * @Route("/showMatchHistory/{id}", name="show_match_history")
    * @Method({"GET"})
    */
    public function showMatchHistoryAction(Request $request, User $summoner) {

        $games = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getRecentGames($summoner->getId());

        return array("summoner" => $summoner, "games" => $games);
    }



    /**
    * Match History
    * @Template()
    * @Route("/ajax_more_game_historic", name="ajax_more_game_historic")
    * @Method({"GET"})
    */
    public function ajaxMoreGameHistoricAction(Request $request) {
        $games = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getRecentGames($request->query->get("id"), 0, $request->query->get("offset"));
        $summoner = $this->getDoctrine()->getRepository("PouzorLolStatBundle:Game")->find($request->query->get("id"));
        return array("summoner" => $summoner, "games" => $games);
    }
}
