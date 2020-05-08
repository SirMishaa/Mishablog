<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\create;
use function DI\get;

return [
    FilesystemLoader::class => create()
        ->constructor(dirname(__DIR__) . '/templates'),

    Environment::class => create()
        ->constructor(get(FilesystemLoader::class)),
];