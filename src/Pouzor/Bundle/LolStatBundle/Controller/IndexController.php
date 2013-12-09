<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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

		return array("summoners" => $summoners);
	}
}
