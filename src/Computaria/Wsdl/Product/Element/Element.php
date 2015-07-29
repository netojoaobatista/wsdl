<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Element
{
    private $name;
    private $type;
    private $wsdl;

    public function __construct($name, Type $type, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->type = $type;
        $this->wsdl = $wsdl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }
}
