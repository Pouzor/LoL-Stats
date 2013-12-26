<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\Game;

class debugDateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('pouzor:debugDate')
        ->setDescription('Debug Date to timestamp to date')


        ;
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $games = $em->getRepository("PouzorLolStatBundle:Game")->findAll();


        foreach ($games as $g) {
            $g->setDateFormat(new \DateTime(date("Y-m-d", $g->getMatchDate())));
        }
        $em->flush();
    }
}
