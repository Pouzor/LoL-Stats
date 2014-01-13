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

      
        $leagues = array(
            1 => "Bronze",
            2 => "Silver",
            3 => "Or",
            4 => "Platine",
            5 => "Diamant",
            6 => "Challenger"
            );

        $data = array();

     

		return array("summoners" => $summoners,
                     "games" => $games,
                 
                     );
	}



}
