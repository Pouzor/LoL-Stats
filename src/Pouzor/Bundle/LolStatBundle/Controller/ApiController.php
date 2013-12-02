<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
*
* @Route("/API")
*
*/
class ApiController extends Controller
{



	/**
	*
	*
	*/
	private function getData($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
    	$header = array("X-Mashape-Authorization: ".$this->container->getParameter('mashape_key'));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	$output = curl_exec($ch);
    	curl_close($ch);
    	return $output;
	}


	/**
	*
	* @Template()
	* @Route("/getAggregatedStats")
	*
	*/
	public function getAggregatedStatsAction() {


		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAggregatedStats/"."33151520");

		print_r($data);die();

		return array();
	}



	/**
	* Get LAST 10 match for the summoners
	* 
	* @Template()
	* @Route("/getRecentGames")
	*
	*/
	public function getRecentGamesAction() {


		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getRecentGames/"."33151520");

		print_r($data);die();

		return array();
	}


}
