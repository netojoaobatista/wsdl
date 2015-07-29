#wsdl

Web Service Description Language parser and client generation

## Traversing the WSDL

```php
<?php
require 'vendor/autoload.php';

use Computaria\Wsdl\Wsdl;

$p = new Wsdl();
$p->load('file.wsdl');

foreach ($p->getServices() as $service) {
    printf("%s\n", $service->getName());

    foreach ($service->getPorts() as $port) {
        printf("\t%s => %s\n", $port->getName(), $port->getAddress());

        $binding = $port->getBinding();
        $portType = $port->getType();

        printf("\t\t%s %s [%s]\n", $portType->getName(),
                                   $binding->getName(),
                                   $binding->getStyle());

        foreach ($portType->getOperations() as $operation) {
            $input = $operation->getInput();
            $output = $operation->getOutput();

            printf("\t\t\t%s %s(%s)\n", $output->getName(),
                                        lcfirst($operation->getName()),
                                        $input->getName());

            printf("\t\t\t\tINPUT: %s -> (e)%s\n", $input->getName(), $input->getElement()->getName());
            printf("\t\t\t\tOUTPUT: %s -> (e)%s\n", $output->getName(), $output->getElement()->getName());
            echo PHP_EOL;
        }

        echo PHP_EOL;
    }
}
```
