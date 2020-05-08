<?php


namespace App\Controller;


class HomeController extends AbstractController
{
    public function render()
    {
        echo $this->twig->render('index.html.twig', []);
        return;
    }
}