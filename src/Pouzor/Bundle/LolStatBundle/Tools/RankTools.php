<?php

namespace Pouzor\Bundle\LolStatBundle\Tools;

class RankTools {

    public static function getLeague($user) {
        if (!$user->getLeague())
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

        if (!isset($leagues[$user->getLeague()]))
            return 0;

        return $leagues[$user->getLeague()]." ".$divisions[$user->getDivision()]." - ".$user->getPoints()." pts";
    }

}

