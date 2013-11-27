<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SummonerController extends Controller
{

	/**
	*
	* @Template()
	* @Route("/show/{id}", name="show_sommoner")
	*
	*/
	public function showAction($id) {

		$summoner = $this->getDoctrine()->getRepository("PouzorLolStatBundle:User")->find($id);

		return array("summoner" => $summoner);
	}

}
