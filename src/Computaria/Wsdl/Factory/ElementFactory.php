<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Element;
use Computaria\Wsdl\Product\Element\Type;
use Computaria\Wsdl\Product\Parser\ElementParser;
use Computaria\Wsdl\Wsdl;

class ElementFactory implements \Computaria\Wsdl\Factory
{
    public function createElement($name, Type $type, Wsdl $wsdl)
    {
        return new Element($name, $type, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new ElementParser($wsdl);
    }
}
