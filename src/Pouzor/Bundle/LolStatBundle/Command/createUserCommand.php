<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\User;

class createUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('pouzor:createUser')
        ->setDescription('Create User from Register tale');
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

        $register = $em->getRepository("PouzorLolStatBundle:Register")->findBy(array("validate" => null));

        foreach ($register as $u) {
            $tuData = $this->get("https://community-league-of-legends.p.mashape.com/api/v1.0/".$u->getServer()."/summoner/getSummonerByName/".$u->getName());

             if (!$tuData) {
                $output->writeln("Erreur connexion");
                return;
            }

            $data = json_decode($tuData, true);

            //New User
            $user = new User();
            $user->setServer($u->getServer());
            $user->setName($u->getName());
            $user->setAccountid($data["acctId"]);
            $user->setSummonersid($data["summonerId"]);
            $user->setSummonersname($data["name"]);
            $user->setPassword(md5(rand()));
            $user->setEmail($u->getEmail());
            $user->setUsername($u->getEmail());

            $u->setValidate(true);
            $em->persist($user);

        }

        $em->flush();
    }


}
