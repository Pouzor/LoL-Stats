<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
	/**
	*
	* @Template()
	* @Route("/", name="homepage")
    * @Method({"GET"})
	*
	*/
	public function indexAction() {

		$summoners = $this->getDoctrine()->getRepository("PouzorLolStatBundle:User")->findAll();
        $games = $this->getDoctrine()->getRepository("PouzorLolStatBundle:Game")->getLastGame();

        $matchs_stats = $this->getDoctrine()->getRepository("PouzorLolStatBundle:Game")->dailyMatch();

      //  print_r($matchs_stats);die();


        $nb = array();
        $date = array();
        $win = array();
        foreach ($matchs_stats as $g) {
            $nb[] = $g["nb"];
            $win[] = $g["win"];
            $date[] = $g["date"]->format("d");
        }

       // echo count($win);echo count($nb);echo count($date);print_r($win);die();


		return array("summoners" => $summoners,
                     "games" => $games,
                     "nb" => json_encode($nb, 1),
                     "win" => json_encode($win, 1),
                     "date" => json_encode($date, 1));
	}

	/**
	*
	* @Route("/search_summoner", name="search_summoner")
	* @Method("GET")
	* @Template()
	*/
	public function searchSummonerAction(Request $request) {
		$api = $this->container->get('pouzor_lol_stat.mashape_api');

		$data = $api->getSummonerByName($request->query->get("server"), $request->query->get("name"));


        return array("summoner" => $data);

	}

}
