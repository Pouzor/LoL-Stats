<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
    *
    * @Template()
    * @Route("/admin", name="homepage_admin")
    * @Method({"GET"})
    *
    */
    public function indexAction() {

        $summoners = $this->getDoctrine()->getRepository("PouzorLolStatBundle:User")->findAll();

        $games = $this->getDoctrine()->getRepository("PouzorLolStatBundle:Game")->getLastGame();

       // $matchs_stats = $this->getDoctrine()->getRepository("PouzorLolStatBundle:Game")->dailyMatch();

        return array("summoners" => $summoners,
                     "games" => $games,
                     );
    }

    /**
    *
    * @Route("/admin/search_summoner", name="search_summoner")
    * @Method("GET")
    * @Template()
    */
    public function searchSummonerAction(Request $request) {
        $api = $this->container->get('pouzor_lol_stat.mashape_api');

        $data = $api->getSummonerByName($request->query->get("server"), $request->query->get("name"));

        return array("summoner" => $data);

    }

}
