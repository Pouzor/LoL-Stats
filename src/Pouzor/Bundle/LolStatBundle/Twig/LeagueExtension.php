<?php

namespace Pouzor\Bundle\LolStatBundle\Twig;

use Pouzor\Bundle\LolStatBundle\Tools\RankTools as RankTools;

class LeagueExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            'getLeague' => new \Twig_Function_Function($this, 'getLeague')
            );
    }


    public function getLeague($s) {
        
        return RankTools::getLeague($s);
    }

    public function getName()
    {
        return 'League_extension';
    }

}



