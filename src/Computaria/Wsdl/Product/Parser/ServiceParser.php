<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class ServiceParser implements Parser
{
    private $wsdl;

    public function __construct(Wsdl $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    public function parse()
    {
        $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
        $xpath = $this->wsdl->getXPath($wsdl);

        foreach ($xpath->query(sprintf('.//%s:service', $wsdl)) as $s) {
            yield $this->wsdl->getFactory()
                             ->createServiceFactory()
                             ->createService(
                                 $s->getAttribute('name'),
                                 $this->wsdl
                             );
        }
    }
}
