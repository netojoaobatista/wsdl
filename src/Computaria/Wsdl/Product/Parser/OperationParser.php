<?php
namespace Computaria\Wsdl\Product\Parser;

use Computaria\Wsdl\Wsdl;

class OperationParser implements Parser
{
    private $wsdl;

    public function __construct(Wsdl $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    public function parse($name)
    {
        $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
        $xpath = $this->wsdl->getXPath($wsdl);

        foreach ($xpath->query(sprintf('.//%s:portType[@name="%s"]/%s:operation',
                                       $wsdl, $name, $wsdl)) as $op) {

            $operation = $this->wsdl->getFactory()
                                    ->createOperationFactory()
                                    ->createOperation($op->getAttribute('name'),
                                                      $name,
                                                      $this->wsdl);

            $input = $xpath->query(sprintf('.//%s:input', $wsdl), $op)->item(0);
            $output = $xpath->query(sprintf('.//%s:output', $wsdl), $op)->item(0);

            if (!is_null($input)) {
                $operation->setInput(
                    $this->getMessagePart($input->getAttribute('message')));
            }

            if (!is_null($output)) {
                $operation->setOutput(
                    $this->getMessagePart($output->getAttribute('message')));
            }

            yield $operation;
        }
    }

    private function getMessagePart($qname)
    {
        if (preg_match('/((?<prefix>[^:]+):)?(?<name>.*)/', $qname, $matches)) {
            $name = $matches['name'];
            $wsdl = $this->wsdl->getPrefix(Wsdl::NS_WSDL);
            $xpath = $this->wsdl->getXPath($wsdl);

            $part = $xpath->query(sprintf('.//%s:message[@name="%s"]/%s:part',
                                          $wsdl,
                                          $name,
                                          $wsdl))->item(0);

            if (!is_null($part)) {
                return $this->wsdl->getFactory()
                                  ->createPartFactory()
                                  ->createPart($part->getAttribute('name'),
                                               $part->getAttribute('element'),
                                               $this->wsdl);
            }
        }
    }
}
