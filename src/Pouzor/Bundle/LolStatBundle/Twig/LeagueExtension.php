<?php

namespace Pouzor\Bundle\LolStatBundle\Twig;


class LeagueExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            'getLeague' => new \Twig_Function_Method($this, 'getLeague')
            );
    }


    public function getLeague($id) {
        if (!$id)
            return "None";        


        $leagues = array(
            1 => "Bronze",
            2 => "Silver",
            3 => "Or",
            4 => "Platine",
            5 => "Diamant",
            6 => "Challenger"
            );

        return $leagues[$id];
    }

    public function getName()
    {
        return 'League_extension';
    }

}



