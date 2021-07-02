<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    private $articles = [
        1 => [
            "title" => "La vaccination c'est trop géniale",
            "content" => "bablablblalba",
            "id" => 1
        ],
        2 => [
            "title" => "La vaccination c'est pas trop géniale",
            "content" => "blablablabla",
            "id" => 2
        ],
        3 => [
            "title" => "Balkany c'est trop génial",
            "content" => "balblalblalb",
            "id" => 3
        ],
        4 => [
            "title" => "Balkany c'est pas trop génial",
            "content" => "balblalblalb",
            "id" => 4
        ]
    ];


    /**
     * @Route("/articles", name="articleList")
     */
    public function articleList()
    {
        return $this->render('article_list.html.twig', [
            'articles' => $this->articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="articleShow")
     */
    public function articleShow($id)
    {
        // j'utilise la méthode render de l'AbstractController
        // pour récupérer un fichier Twig, le transformer en HTML
        // et le renvoyer en réponse HTTP au navigateur
        // Pour utiliser des variables dans le fichier twig, je dois
        // lui passer un tableau en second parametre, avec toutes les
        // variables que je veux utiliser
        return $this->render('article_show.html.twig', [
            'article' => $this->articles[$id]
        ]);
    }

}
