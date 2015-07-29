<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Service;
use Computaria\Wsdl\Product\Parser\ServiceParser;
use Computaria\Wsdl\Wsdl;

class ServiceFactory implements \Computaria\Wsdl\Factory
{
    public function createService($name, Wsdl $wsdl)
    {
        return new Service($name, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new ServiceParser($wsdl);
    }
}
