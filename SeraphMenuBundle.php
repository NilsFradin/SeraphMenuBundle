<?php

namespace Seraph\Bundle\MenuBundle;

use Seraph\Bundle\MenuBundle\DependencyInjection\SeraphMenuExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SeraphMenuBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SeraphMenuExtension();
    }

}