<?php
namespace Computaria\Wsdl\Product\Element;

use Computaria\Wsdl\Wsdl;

class Operation
{
    private $name;
    private $portType;
    private $wsdl;
    private $input;
    private $output;

    public function __construct($name, $portType, Wsdl $wsdl)
    {
        $this->name = $name;
        $this->portType = $portType;
        $this->wsdl = $wsdl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setInput(Part $part)
    {
        $this->input = $part;
    }

    public function setOutput(Part $part)
    {
        $this->output = $part;
    }
}
