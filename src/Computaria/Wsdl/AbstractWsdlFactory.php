<?php
namespace Computaria\Wsdl;

abstract class AbstractWsdlFactory
{
    abstract public function createBindingFactory();

    abstract public function createElementFactory();

    abstract public function createOperationFactory();

    abstract public function createPartFactory();

    abstract public function createPortFactory();

    abstract public function createPortTypeFactory();

    abstract public function createServiceFactory();

    abstract public function createTypeFactory();
}
