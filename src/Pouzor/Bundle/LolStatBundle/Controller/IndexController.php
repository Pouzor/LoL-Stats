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

        $leagues = array(
            1 => "Bronze",
            2 => "Silver",
            3 => "Or",
            4 => "Platine",
            5 => "Diamant",
            6 => "Challenger"
            );

        $data = array();

        foreach ($matchs_stats as $g)
            $data[] = array("date" => $g["date"]->format("d-M"), "win" => (int) $g["win"], "nb" => (int) $g["nb"], "ranked" => (int) $g["ranked"]);

        $data = array_reverse($data);

		return array("summoners" => $summoners,
                     "games" => $games,
                     "data" => json_encode($data, 1)
                     );
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
