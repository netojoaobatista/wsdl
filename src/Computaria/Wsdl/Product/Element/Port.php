<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Port
{
    private $name;
    private $address;
    private $binding;
    private $wsdl;

    public function __construct($name, $address, $binding, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->address = $address;
        $this->binding = $binding;
        $this->wsdl = $wsdl;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getBinding()
    {
        return $this->wsdl->getBinding($this->binding);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->wsdl->getPortType($this->getBinding()->getType());
    }
}
