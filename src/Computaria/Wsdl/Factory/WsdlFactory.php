<?php
namespace Computaria\Wsdl\Factory;

use Computaria\Wsdl\AbstractWsdlFactory;
use Computaria\Wsdl\Factory\BindingFactory;
use Computaria\Wsdl\Factory\ElementFactory;
use Computaria\Wsdl\Factory\OperationFactory;
use Computaria\Wsdl\Factory\PartFactory;
use Computaria\Wsdl\Factory\PortFactory;
use Computaria\Wsdl\Factory\PortTypeFactory;
use Computaria\Wsdl\Factory\ServiceFactory;
use Computaria\Wsdl\Factory\TypeFactory;

class WsdlFactory extends \Computaria\Wsdl\AbstractWsdlFactory
{
    public function createBindingFactory()
    {
        return new BindingFactory();
    }

    public function createElementFactory()
    {
        return new ElementFactory();
    }

    public function createOperationFactory()
    {
        return new OperationFactory();
    }

    public function createPartFactory()
    {
        return new PartFactory();
    }

    public function createPortFactory()
    {
        return new PortFactory();
    }

    public function createPortTypeFactory()
    {
        return new PortTypeFactory();
    }

    public function createServiceFactory()
    {
        return new ServiceFactory();
    }

    public function createTypeFactory()
    {
        return new TypeFactory();
    }
}
