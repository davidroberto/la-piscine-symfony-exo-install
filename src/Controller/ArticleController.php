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
            "title" => "Politique",
            "content" => "Tous les articles liés à Jean Lassalle",
            "id" => 1,
            "published" => true,
        ],
        2 => [
            "title" => "Economie",
            "content" => "Les meilleurs tuyaux pour avoir DU FRIC",
            "id" => 2,
            "published" => true
        ],
        3 => [
            "title" => "Securité",
            "content" => "Attention les étrangers sont très méchants",
            "id" => 3,
            "published" => false
        ],
        4 => [
            "title" => "Ecologie",
            "content" => "Hummer <3",
            "id" => 4,
            "published" => true
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
     * @Route("/articles/{id}", name="articleShow")
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
