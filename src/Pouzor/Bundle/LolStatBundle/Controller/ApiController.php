<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unirest\Unirest;

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

/*
        $response = Unirest::get(
                                 "https://scalpweb-lolapi.p.mashape.com/getSummonerMatchHistory/euw/Pouzor",
                                 array(
                                       "X-Mashape-Authorization" => "FyMpFNXeHZ5AEYbTrbvuuscIFtk0Hdg4"
                                       ),
                                 null
                                 );

print_r($response);die();
*/

        $response = Unirest::get(
                                 "https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getRecentGames/33151520",
                                 array(
                                       "X-Mashape-Authorization" => "FyMpFNXeHZ5AEYbTrbvuuscIFtk0Hdg4"
                                       ),
                                 null
                                 );

      //  $data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getRecentGames/33151520");

        print_r($response);die();

        return array();
    }

	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/getAllPublicSummonerDataByAccount")
	*
	*/
	public function getAllPublicSummonerDataByAccountAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAllPublicSummonerDataByAccount/"."33151520");

		print_r($data);die();

		return array();
	}




	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/getLeagueForPlayer")
	*
	*/
	public function getLeagueForPlayerAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getLeagueForPlayer/"."33151520");

		print_r($data);die();

		return array();
	}

	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/retrievePlayerStatsByAccountId")
	*
	*/
	public function retrievePlayerStatsByAccountIdAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrievePlayerStatsByAccountId/"."33151520");

		print_r($data);die();

		return array();
	}


	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/retrieveTopPlayedChampions")
	*
	*/
	public function retrieveTopPlayedChampionsAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrieveTopPlayedChampions/"."33151520");

		print_r($data);die();

		return array();
	}


}
