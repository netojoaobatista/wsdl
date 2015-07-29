<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class PortTypeParser implements Parser
{
    private $wsdl;

    public function __construct(Wsdl $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    public function parse($qname)
    {
        $matches = [];

        if (preg_match('/((?<prefix>[^:]+):)?(?<name>.*)/', $qname, $matches)) {
            $name = $matches['name'];
            $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
            $xpath = $this->wsdl->getXPath($wsdl);

            $pt = $xpath->query(sprintf('.//%s:portType[@name="%s"]',
                                        $wsdl,
                                        $name))->item(0);

            if (!is_null($pt)) {
                return $this->wsdl->getFactory()
                                  ->createPortTypeFactory()
                                  ->createPortType($pt->getAttribute('name'),
                                                   $this->wsdl);
            }
        }
    }
}
