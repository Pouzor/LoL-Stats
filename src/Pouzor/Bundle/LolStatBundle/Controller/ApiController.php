<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unirest\Unirest;
use Symfony\Component\HttpFoundation\Response;

/**
*
* @Route("/API")
*
*/
class ApiController extends Controller
{

    private $json = null;

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
    * @Route("/showJson", name="showJson")
    *
    */
    public function showJsonAction($json) {

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


	/**
	*
	* @Template()
	* @Route("/getAggregatedStats")
	*
	*/
	public function getAggregatedStatsAction() {


		$this->json = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAggregatedStats/"."33151520");



        $this->redirect($this->generateUrl("showJson"));

    }



	/**
	* Get LAST 10 match for the summoners
	*
	* @Template()
	* @Route("/getRecentGames")
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

        $this->redirect($this->generateUrl("showJson"));
    }



	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/getAllPublicSummonerDataByAccount")
	*
	*/
	public function getAllPublicSummonerDataByAccountAction() {
		$this->json = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getAllPublicSummonerDataByAccount/"."33151520");

        $this->redirect($this->generateUrl("showJson"));
    }




	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/getLeagueForPlayer")
	*
	*/
	public function getLeagueForPlayerAction() {
		$this->json = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/getLeagueForPlayer/"."33151520");

        $this->redirect($this->generateUrl("showJson"));
    }

	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/retrievePlayerStatsByAccountId")
	*
	*/
	public function retrievePlayerStatsByAccountIdAction() {
		$this->json = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrievePlayerStatsByAccountId/"."33151520");

        $this->redirect($this->generateUrl("showJson"));
    }


	/**
	*
	* Pulls all data about a summoner
	* @Template()
	* @Route("/retrieveTopPlayedChampions")
	*
	*/
	public function retrieveTopPlayedChampionsAction() {
		$this->json = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/EUW/summoner/retrieveTopPlayedChampions/"."33151520");

        $this->redirect($this->generateUrl("showJson"));
    }


}
