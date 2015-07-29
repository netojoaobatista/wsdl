<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Binding
{
    private $name;
    private $type;
    private $style;
    private $transport;
    private $wsdl;

    public function __construct($name, $type, $style, $transport, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->type = $type;
        $this->style = $style;
        $this->transport = $transport;
        $this->wsdl = $wsdl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function getTransport()
    {
        return $this->transport;
    }

    public function getType()
    {
        return $this->type;
    }
}
