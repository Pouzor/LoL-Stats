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



		return array("summoners" => $summoners,
                     "games" => $games);
	}

	/**
	*
	* @Route("/search_summoner", name="search_summoner")
	* @Method("POST")
	* @Template()
	*/
	public function searchSummonerAction(Request $request) {
		$api = $this->container->get('pouzor_lol_stat.mashape_api');

		$data = $api->getSummonerByName($request->request->get("server"), $request->request->get("name"));


        return array("summoner" => $data);

	}

}
