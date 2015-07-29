<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class ElementParser implements Parser
{
    private $wsdl;

    public function __construct(Wsdl $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    public function parse($qname)
    {
        if (preg_match('/((?<prefix>[^:]+):)?(?<name>.*)/', $qname, $matches)) {
            $name = $matches['name'];
            $prefix = $matches['prefix'];
            $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
            $xsd = $this->wsdl->getPrefix(Wsdl::NS_XSD);
            $xpath = $this->wsdl->getXPath($prefix);

            $element = $xpath->query(
                sprintf('.//%s:types/%s:schema/%s:element[@name="%s"]',
                        $wsdl,
                        $xsd,
                        $xsd,
                        $name))->item(0);

            var_dump($element->getAttribute('name'));
            var_dump($element->getAttribute('type'));
        }
    }
}
