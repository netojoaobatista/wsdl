<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Service
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

    public function getPorts()
    {
        return $this->wsdl->getPorts($this->name);
    }
}
