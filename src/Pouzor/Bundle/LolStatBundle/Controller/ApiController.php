<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Unirest\Unirest;
use Symfony\Component\HttpFoundation\Response;

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
    * @Method({"GET"})
	*
	*/
	public function getAggregatedStatsAction() {


		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAggregatedStats/"."33151520");

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;



	}



	/**
	* Get LAST 10 match for the summoners
	*
	* @Template()
	* @Route("/getRecentGames")
    * @Method({"GET"})
	*
	*/
	public function getRecentGamesAction() {


        $response = Unirest::get(
                                 "https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getRecentGames/33151520",
                                 array(
                                       "X-Mashape-Authorization" => $this->container->getParameter('mashape_key')
                                       ),
                                 null
                                 );





        $response = new Response($response->__get("raw_body"));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



	/**
	*
	* RUNE PAGES
	* @Template()
	* @Route("/getAllPublicSummonerDataByAccount")
    * @Method({"GET"})
	*
	*/
	public function getAllPublicSummonerDataByAccountAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAllPublicSummonerDataByAccount/"."33151520");

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
	}




	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/getLeagueForPlayer")
    * @Method({"GET"})
	*
	*/
	public function getLeagueForPlayerAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getLeagueForPlayer/"."33151520");

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        var_dump($data);

        return $response;
	}

	/**
	*
	* Get all total kill, assist etc... by type
	* @Template()
	* @Route("/retrievePlayerStatsByAccountId")
    * @Method({"GET"})
	*
	*/
	public function retrievePlayerStatsByAccountIdAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrievePlayerStatsByAccountId/"."33151520");

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
	}


	/**
	*
	* Get trop 5 champ with special stats (penta, max k/d/a etc...)
	* @Template()
	* @Route("/retrieveTopPlayedChampions")
    * @Method({"GET"})
	*
	*/
	public function retrieveTopPlayedChampionsAction() {
		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrieveTopPlayedChampions/"."33151520");

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
	}


}
