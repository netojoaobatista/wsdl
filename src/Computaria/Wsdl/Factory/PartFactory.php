<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Part;
use Computaria\Wsdl\Product\Parser\PartParser;
use Computaria\Wsdl\Wsdl;

class PartFactory implements \Computaria\Wsdl\Factory
{
    public function createPart($name, $element, Wsdl $wsdl)
    {
        return new Part($name, $element, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new PartParser($wsdl);
    }
}
