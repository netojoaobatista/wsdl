<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class PortParser implements Parser
{
    private $wsdl;

    public function __construct(Wsdl $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    public function parse($service)
    {
        $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
        $xpath = $this->wsdl->getXPath($wsdl);

        foreach ($xpath->query(sprintf(
            './/%s:service[@name="%s"]/%s:port',
            $wsdl,
            $service,
            $wsdl
        )) as $p) {
            $address = $p->getElementsByTagNameNS(Wsdl::NS_SOAP, 'address')
                         ->item(0);

            if ($address !== null) {
                $location = $address->getAttribute('location');
                $name = $p->getAttribute('name');
                $binding = $p->getAttribute('binding');

                yield $this->wsdl->getFactory()
                                 ->createPortFactory()
                                 ->createPort(
                                     $name,
                                     $location,
                                     $binding,
                                     $this->wsdl
                                 );
            }
        }
    }
}
