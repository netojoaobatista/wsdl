<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\PortType;
use Computaria\Wsdl\Product\Parser\PortTypeParser;
use Computaria\Wsdl\Wsdl;

class PortTypeFactory implements \Computaria\Wsdl\Factory
{
    public function createPortType($name, Wsdl $wsdl)
    {
        return new PortType($name, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new PortTypeParser($wsdl);
    }
}
