<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{

    /**
     * @Route("/articles", name="articleList")
     */
    public function articleList()
    {
        return new Response("articles");
    }

    /**
     * j'utilise le système de wildcard de Symfony
     * pour déclarer une URL avec une "variable" "id"
     * qui se situe après "/article/"
     * Pour récupérer la valeur de cette variable (wildcard)
     * j'ai simplement a passer en parametre de méthode
     * une variable qui a le même nom que la wildcard
     * @Route("/article/{id}", name="articleShow")
     */
    public function articleShow($id)
    {
        return new Response($id);
    }

}
