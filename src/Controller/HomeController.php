<?php

namespace App\src\Controller;

use App\src\Controller\TwigController;

class HomeController extends TwigController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo $this->twig->render('home/index.html.twig', [
            'data' => 'Bienvenue sur le controller Home!'
        ]);
    }
}
