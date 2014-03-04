<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReduceItemCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('pouzor:reduceItem')
        ->setDescription('Migrate DB to item in game to many-to-many')


        ;
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $games = $em->getRepository("PouzorLolStatBundle:Game")->findAll();


        foreach ($games as $g) {
            if ($g->getItem0() && $g->getItem0()->getId() != 0) {
                $item = $g->getItem0();
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem1() && $g->getItem1()->getId() != 0) {
                $item = $g->getItem1();
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem2()) {
                $item = $em->getReference("PouzorLolStatBundle:Item", $g->getItem2());
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem3()) {
                $item = $em->getReference("PouzorLolStatBundle:Item", $g->getItem3());
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem4()) {
                $item = $em->getReference("PouzorLolStatBundle:Item", $g->getItem4());
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem5()) {
                $item = $em->getReference("PouzorLolStatBundle:Item", $g->getItem5());
                $g->addItem($item);
                $em->persist($g);
            }
            if ($g->getItem6()) {
                $item = $em->getReference("PouzorLolStatBundle:Item", $g->getItem6());
                $g->addItem($item);
                $em->persist($g);
            }

        }




        $em->flush();



    }
}