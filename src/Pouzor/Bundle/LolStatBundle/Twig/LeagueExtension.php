<?php

namespace Pouzor\Bundle\LolStatBundle\Twig;


class LeagueExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            'getLeague' => new \Twig_Function_Method($this, 'getLeague')
            );
    }


    public function getLeague($s) {
        if (!$s->getLeague())
            return "None";


        $leagues = array(
            1000 => "Bronze",
            2000 => "Silver",
            3000 => "Or",
            4000 => "Platine",
            5000 => "Diamant",
            6000 => "Challenger"
            );


        $divisions = array(
                           100 => "V",
                           200 => "IV",
                           300 => "III",
                           400 => "II",
                           500 => "I"
                           );

        if (!isset($leagues[$s->getLeague()]))
            return 0;



        return $leagues[$s->getLeague()]." ".$divisions[$s->getDivision()]." - ".$s->getPoints()." pts";

    }

    public function getName()
    {
        return 'League_extension';
    }

}



