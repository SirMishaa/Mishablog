<?php

use App\Kernel;
use DI\ContainerBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = (new ContainerBuilder())
    ->addDefinitions(dirname(__DIR__) . '/src/autowiring.php');
$container = $containerBuilder->build();

$router = $container->get(AltoRouter::class);
$router->map('GET', '/', '\App\Controller\HomeController');

$container->call([Kernel::class, 'handleRequest']);

// Get method in \Di\Container will return the same objet (like singleton). Use make to get new instance.
