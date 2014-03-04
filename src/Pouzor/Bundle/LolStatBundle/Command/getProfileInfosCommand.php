<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetProfileInfosCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('pouzor:getProfileInfos')
        ->setDescription('Get Summoners infos');
    }

    /**
     * @param string $url
     */
    private function get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $header = array("X-Mashape-Authorization: ".$this->getContainer()->getParameter('mashape_key'));//Mashable
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $users = $em->getRepository("PouzorLolStatBundle:User")->findAll();

        foreach ($users as $u) {
            $tuData = $this->get("https://community-league-of-legends.p.mashape.com/api/v1.0/".$u->getServer()."/summoner/getAllPublicSummonerDataByAccount/".$u->getAccountid());

             if (!$tuData) {
                $output->writeln("Erreur connexion");
                return;
            }

            $data = json_decode($tuData, true);

            $u->setIcon($data["summoner"]["profileIconId"]);



        }
        $em->flush();

    }


}
