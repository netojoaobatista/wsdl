<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Type;
use Computaria\Wsdl\Product\Parser\TypeParser;
use Computaria\Wsdl\Wsdl;

class TypeFactory implements \Computaria\Wsdl\Factory
{
    public function createType()
    {
        return new Type();
    }

    public function createParser(Wsdl $wsdl)
    {
        return new TypeParser($wsdl);
    }
}
