<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require dirname(__DIR__) . '/vendor/autoload.php';

$twig = new Environment(new FilesystemLoader(dirname(__DIR__) . '/templates'));
echo $twig->render('index.html.twig');