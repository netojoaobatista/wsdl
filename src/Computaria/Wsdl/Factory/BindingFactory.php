<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\Product\Element\Binding;
use Computaria\Wsdl\Product\Parser\BindingParser;
use Computaria\Wsdl\Wsdl;

class BindingFactory implements \Computaria\Wsdl\Factory
{
    public function createBinding(
        $name,
        $type,
        $style,
        $transport,
        Wsdl $wsdl
    ) {
        return new Binding($name, $type, $style, $transport, $wsdl);
    }

    public function createParser(Wsdl $wsdl)
    {
        return new BindingParser($wsdl);
    }
}
