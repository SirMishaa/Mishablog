<?php


namespace App\Controller;

use Twig\Environment;

abstract class AbstractController
{

    /**
     * @var Environment
     */
    protected Environment $twig;

    public function __construct(Environment $twig)
    {


        $this->twig = $twig;
        // Todo : Make $this->render() request instead of $this->twig->render()
    }
}