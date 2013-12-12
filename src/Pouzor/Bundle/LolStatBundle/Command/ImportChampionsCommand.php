<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\Champion;

class ImportChampionsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('pouzor:importChampions')
        ->setDescription('Import json definition of champions')
        ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'File to import'
            )

        ;
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();


        $file  = $input->getArgument('file');
        $json = file_get_contents($file);

        if (!$json) {
            $output->writeln("<error>Error opening file</error>");
            return;
        }

        $json = json_decode($json, true);


        if (!isset($json["data"]) || !is_array($json["data"])) {
            $output->writeln("<error>Error in file</error>");
            return;
        }    


        foreach ($json["data"] as $champ) {
            $champion = $em->getRepository("PouzorLolStatBundle:Champion")->find($champ["key"]);

            if (!$champion) {
               $output->writeln("Create new champion : ".$champ["name"]." - ".$champ["key"]);
               
               $champion = new Champion();
               $champion->setId($champ["key"]); 
               $em->persist($champion);
               $metadata = $em->getClassMetaData(get_class($champion));
               $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            }
            else {
              $output->writeln("Update : ".$champ["name"]." - ".$champ["key"]);  
            }

            $champion->setName($champ["name"]);
            $champion->setTitle($champ["title"]);
            $champion->setBlurb($champ["blurb"]);
            

        }
        $em->flush();



    }
}