<?php

use App\Kernel;
use DI\ContainerBuilder;
use DI\FactoryInterface;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testHandleRequestProperly()
    {
        $container = ((new ContainerBuilder())
            ->useAutowiring(true)
            ->addDefinitions(dirname(__DIR__) . '/src/autowiring.php'))->build();

        $router = $container->get(AltoRouter::class);
        $router->map('GET', '/', function () {
            $this->assertTrue(true, 'Callback function of router should be called');
            // Todo : rework this, it should use Mock test, cf :
            // https://stackoverflow.com/questions/9296529/phpunit-how-to-test-if-callback-gets-called
        });

        $hasBeenHandled = $container->call([Kernel::class, 'handleRequest'],
            [
                $container->get(AltoRouter::class),
                $container->get(FactoryInterface::class),
                '/'
            ]);
        $this->assertTrue($hasBeenHandled, 'HandleRequest should return true if route has been matched');
    }
}
