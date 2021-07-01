<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // je retourne une réponse HTTP valide en utilisant
        // la classe Response du composant HTTPFoundation
        return new Response('Accueil');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        var_dump('contact'); die;
    }


    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        var_dump('test'); die;
    }
}
