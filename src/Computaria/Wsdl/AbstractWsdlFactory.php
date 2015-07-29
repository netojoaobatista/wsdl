<?php
namespace Computaria\Wsdl;

abstract class AbstractWsdlFactory
{
    public abstract function createBindingFactory();

    public abstract function createElementFactory();

    public abstract function createOperationFactory();

    public abstract function createPartFactory();

    public abstract function createPortFactory();

    public abstract function createPortTypeFactory();

    public abstract function createServiceFactory();

    public abstract function createTypeFactory();
}
