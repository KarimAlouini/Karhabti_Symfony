<?php

namespace Limitless\KarhabtiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LimitlessKarhabtiBundle extends Bundle
{
    public function getParent(){
        return "FOSUserBundle";
    }
}
