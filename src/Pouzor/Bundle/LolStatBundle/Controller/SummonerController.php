<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

        $winRates = $this->getDoctrine()->getManager()->getRepository("PouzorLolStatBundle:Game")->getWinRates($id);



		return array("summoner" => $summoner, "stats" => $stats);
	}

}
