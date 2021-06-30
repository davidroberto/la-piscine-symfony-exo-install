<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class PageController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        var_dump('Accueil'); die;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        var_dump('contact'); die;
    }
}
