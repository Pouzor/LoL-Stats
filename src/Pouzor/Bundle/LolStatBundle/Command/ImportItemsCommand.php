<?php

namespace Pouzor\Bundle\LolStatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pouzor\Bundle\LolStatBundle\Entity\Item;

class ImportItemsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('pouzor:importItems')
            ->setDescription('Import json definition of items')
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


        foreach ($json["data"] as $id => $i) {
            $item = $em->getRepository("PouzorLolStatBundle:Item")->find($id);

            if (!$item) {
                $output->writeln("Create new item : ".$i["name"]." - ".$id);

                $item = new Item();
                $item->setId($id);
                $em->persist($item);
                $metadata = $em->getClassMetaData(get_class($item));
                $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            }
            else {
                $output->writeln("Update : ".$i["name"]." - ".$id);
            }


            $item->setName($i["name"]);
            $item->setDescription($i["description"]);
            $item->setGroups(isset($i["group"]) ? $i["group"] : "");
            $item->setPlaintext(isset($i["plaintext"]) ? $i["plaintext"] : "");
            $item->setTotalCost($i["gold"]["total"]);


        }
        $em->flush();



    }
}