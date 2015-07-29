<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Operation;
use Computaria\Wsdl\Product\Parser\OperationParser;
use Computaria\Wsdl\Wsdl;

class OperationFactory implements \Computaria\Wsdl\Factory
{
    public function createOperation($name, $portType, Wsdl $wsdl)
    {
        return new Operation($name, $portType, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new OperationParser($wsdl);
    }
}
