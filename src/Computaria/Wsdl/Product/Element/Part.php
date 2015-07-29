<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Part
{
    private $name;
    private $element;
    private $wsdl;

    public function __construct($name, $element, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->element = $element;
        $this->wsdl = $wsdl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getElement()
    {
        return $this->wsdl->getFactory()
                          ->createElementFactory()
                          ->createParser($this->wsdl)
                          ->parse($this->element);
    }
}
