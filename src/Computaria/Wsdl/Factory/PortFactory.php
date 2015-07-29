<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Port;
use Computaria\Wsdl\Product\Parser\PortParser;
use Computaria\Wsdl\Wsdl;

class PortFactory implements \Computaria\Wsdl\Factory
{
    public function createPort($name, $address, $binding, Wsdl $wsdl)
    {
        return new Port($name, $address, $binding, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new PortParser($wsdl);
    }
}
