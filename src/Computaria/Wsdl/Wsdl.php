<?php
namespace Computaria\Wsdl;

use Computaria\Wsdl\Factory\WsdlFactory;

class Wsdl
{
    const NS_WSDL = 'http://schemas.xmlsoap.org/wsdl/';
    const NS_XSD = 'http://www.w3.org/2001/XMLSchema';
    const NS_SOAP_ENC = 'http://schemas.xmlsoap.org/soap/encoding/';
    const NS_SOAP = 'http://schemas.xmlsoap.org/wsdl/soap/';

    private $factory;

    private $imports = [];

    private $targetNS;
    private $ns = [];
    private $prefix = [
        Wsdl::NS_WSDL => '',
        Wsdl::NS_XSD => '',
        Wsdl::NS_SOAP_ENC => '',
        Wsdl::NS_SOAP => ''
    ];

    public function __construct(AbstractWsdlFactory $factory = null)
    {
        if ($factory !== null) {
            $this->factory = $factory;
        }
    }

    protected function createDefaultFactory()
    {
        return new WsdlFactory();
    }

    public function getFactory()
    {
        if ($this->factory == null) {
            $this->factory = $this->createDefaultFactory();
        }

        return $this->factory;
    }

    public function getPrefix($namespace)
    {
        return $this->prefix[$namespace];
    }

    public function getXpath($prefix)
    {
        return $this->ns[$prefix]->xpath;
    }

    public function getDOM($prefix)
    {
        return $this->ns[$prefix]->dom;
    }

    public function getBinding($qname)
    {
        return $this->getFactory()->createBindingFactory()
                                  ->createParser($this)
                                  ->parse($qname);
    }

    public function getElement($qname)
    {
        return $this->getFactory()->createElementFactory()
                                  ->createParser($this)
                                  ->parse($qname);
    }

    public function getOperations($name)
    {
        return $this->getFactory()->createOperationFactory()
                                  ->createParser($this)
                                  ->parse($name);
    }

    public function getPortType($qname)
    {
        return $this->getFactory()->createPortTypeFactory()
                                  ->createParser($this)
                                  ->parse($qname);
    }

    public function getPorts($service)
    {
        return $this->getFactory()->createPortFactory()
                                  ->createParser($this)
                                  ->parse($service);
    }

    public function getServices()
    {
        return $this->getFactory()->createServiceFactory()
                                  ->createParser($this)
                                  ->parse();
    }

    public function load($xml)
    {
        $path = dirname($xml);

        $dom = new \DOMDocument();
        $dom->load($xml);

        $xpath = new \DOMXPath($dom);

        $currentDocument = new \stdClass;
        $currentDocument->dom = $dom;
        $currentDocument->xpath = $xpath;

        $targetNamespace = $dom->documentElement->getAttribute('targetNamespace');

        // registering document namespace
        $this->ns[$dom->documentElement->prefix] = $currentDocument;
        $xpath->registerNamespace(
            $dom->documentElement->prefix,
            $dom->documentElement->namespaceURI
        );

        // registering defined namespaces
        foreach ($xpath->query('namespace::*', $dom->documentElement) as $ns) {
            if (!isset($this->ns[$ns->localName])) {
                $this->ns[$ns->localName] = $currentDocument;
                $xpath->registerNamespace($ns->localName, $ns->namespaceURI);

                if ($ns->namespaceURI == $targetNamespace) {
                    $this->targetNS = $ns->localName;
                }

                if (isset($this->prefix[$ns->namespaceURI])) {
                    $this->prefix[$ns->namespaceURI] = $ns->localName;
                }
            }
        }

        // loading imports
        // TODO: make optional
        foreach ($xpath->query(sprintf(
            './/%s:import/@schemaLocation',
            $this->prefix[Wsdl::NS_XSD]
        )) as $schemaLocation) {
            $import = sprintf("%s/%s", $path, $schemaLocation->nodeValue);

            if (!isset($this->imports[$schemaLocation->nodeValue])) {
                $this->imports[$schemaLocation->nodeValue] = $import;
                $this->load($import);
            }
        }
    }
}
