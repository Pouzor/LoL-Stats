<?php

namespace Pouzor\Bundle\LolStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pouzor\Bundle\LolStatBundle\Tools\RankTools as RankTools;
use Pouzor\Bundle\LolStatBundle\Form\RegisterType;
use Pouzor\Bundle\LolStatBundle\Entity\Register;

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
            return new Response("<div style='padding: 20px;text-align: center;'><a href='".$this->generateUrl('show_summoner', array("id" => $summoner->getId()))."'>".$summoner->getName() ." - ". RankTools::getLeague($summoner)."</a></div>");
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

        $form = $this->createForm(new RegisterType(), new Register());

        return array("form" => $form->createView());
    }

    /**
    *
    * @Route("/submit_register", name="submit_register")
    * @Method("POST")
    */
    public function submitRegisterAction(Request $request) {
        $form = $this->createForm(new RegisterType(), new Register());

        $form->bind($request);

        if ($form->isValid()) {
            $register = $form->getData();
            $this->getDoctrine()->getManager()->persist($register);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl("register_success"));
        }

        return $this->redirect($this->generateUrl("register?error=true"));
    }

    /**
    *
    * @Route("/register_success", name="register_success")
    * @Method("GET")
    * @Template()
    */
    public function registerSuccessAction() {

        return array();
    }

}
