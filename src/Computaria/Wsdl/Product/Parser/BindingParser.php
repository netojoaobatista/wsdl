<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class BindingParser implements Parser
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
            $soap = $this->wsdl->getPrefix(Wsdl::NS_SOAP);
            $xpath = $this->wsdl->getXPath($wsdl);

            $b = $xpath->query(sprintf('.//%s:binding[@name="%s"]',
                                       $wsdl,
                                       $name))->item(0);

            if (!is_null($b)) {
               $bindingName = $b->getAttribute('name');
               $bindingType = $b->getAttribute('type');
               $bindingStyle = '';
               $bindingTransport = '';

               $soapBinding = $xpath->query(sprintf('.//%s:binding', $soap),
                                            $b)->item(0);

               if (!is_null($soapBinding)) {
                   $bindingStyle = $soapBinding->getAttribute('style');
                   $bindingTransport = $soapBinding->getAttribute('transport');
               }

               return $this->wsdl->getFactory()
                                 ->createBindingFactory()
                                 ->createBinding($bindingName,
                                                $bindingType,
                                                $bindingStyle,
                                                $bindingTransport,
                                                $this->wsdl);
            }
        }
    }
}
