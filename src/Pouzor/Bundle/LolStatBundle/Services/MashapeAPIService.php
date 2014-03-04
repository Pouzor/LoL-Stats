<?php

namespace Pouzor\Bundle\LolStatBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;


class MashapeAPIService
{
	
	protected $em;
	protected $container;

	public function __construct(EntityManager $em, Container $container)
	{
		$this->em = $em;
		$this->container = $container;
	}


	/**
	* Execute Curl API for specific url
	*
	* @param string $url
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

		return json_decode($output, true);
	}


	/**
	* Get summoner info, fetch by summoner name and server
	* 
	*/
	public function getSummonerByName($server, $summoner) {

		$data = $this->getData("https://community-league-of-legends.p.mashape.com/api/v1.0/".$server."/summoner/getSummonerByName/".$summoner);

		return $data;
	}

}