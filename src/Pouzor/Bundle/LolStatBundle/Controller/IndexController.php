<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pouzor\Bundle\LolStatBundle\Tools\RankTools as RankTools;

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


        return array(
            "summoners" => $summoners,
            "games" => $games,

            );
    }


    /**
    *
    * @Route("/search_summoner_platform", name="search_summoner_platform")
    * @Method("GET")
    * @Template()
    */
    public function searchSummonerPlatformAction(Request $request) {

        $summoner = $this->getDoctrine()
        ->getRepository("PouzorLolStatBundle:User")
        ->findOneBy(array("summonersname" => $request->query->get("name"), "server" => $request->query->get("server")));

        if ($summoner) {
            return new Response("<div style='padding: 20px;text-align: center;'><a href='".$this->generateUrl('show_sommoner', array("id" => $summoner->getId()))."'>".$summoner->getName() ." - ". RankTools::getLeague($summoner)."</a></div>");
        }
        else
            return new Response("<div style='padding: 20px;text-align: center;'>User not found, have you <a href='".$this->generateUrl('register')."'>register</a> this summoner ?</div>");

    }


    /**
    *
    * @Route("/register", name="register")
    * @Method("GET")
    * @Template()
    */
    public function registerAction() {

        return array();
    }


}
