<?php


namespace App;

use AltoRouter;
use DI\DependencyException;
use DI\FactoryInterface;
use DI\NotFoundException;
use Exception;

class Kernel
{

    /**
     * @param AltoRouter $router
     * @param FactoryInterface $factory
     * @param string|null $url
     * @return bool
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function handleRequest(AltoRouter $router, FactoryInterface $factory, ?string $url = null): bool
    {
        isset($url) ? $match = $router->match($url) : $match = $router->match();
        if (is_array($match) && !empty($match['target'])) {

            if (is_object($match['target'])) {
                call_user_func($match['target']);
                return true;
            }

            $target = explode('#', $match['target']);
            $targetLength = count($target);

            if ($targetLength > 0 && $targetLength <= 2) {
                $invokableController = $factory->make($target[0]);
                $targetLength > 1
                    ? call_user_func([$invokableController, $target[1]])
                    : call_user_func([$invokableController, 'render']);
                return true;
            }
            throw new Exception("Route target should be in the following format : 
            '\App\Controller\HomeController' or '\App\Controller\HomeController#method'");

        } else {
            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            return false;
        }
    }
}