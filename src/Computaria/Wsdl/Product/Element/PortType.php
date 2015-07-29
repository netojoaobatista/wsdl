<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class PortType
{
    private $name;
    private $wsdl;

    public function __construct($name, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->wsdl = $wsdl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOperations()
    {
        return $this->wsdl->getOperations($this->name);
    }
}
