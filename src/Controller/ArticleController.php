<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{


    /**
     * @Route("/articles", name="articleList")
     */
    public function articleList(ArticleRepository $articleRepository)
    {
        // je dois faire une requête SQL SELECT en bdd
        // sur la table article
        // La classe qui me permet de faire des requêtes SELECT est ArticleRepository
        // donc je dois instancier cette classe
        // pour ça, j'utilise l'autowire (je place la classe en argument du controleur,
        // suivi de la variable dans laquelle je veux que sf m'instancie la classe
        $articles = $articleRepository->findAll();

        return $this->render('article_list.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/articles/{id}", name="articleShow")
     */
    public function articleShow($id, ArticleRepository $articleRepository)
    {
        // afficher un article en fonction de l'id renseigné dans l'url (en wildcard)
        $article = $articleRepository->find($id);

        // si l'article n'a pas été trouvé, je renvoie une exception (erreur)
        // pour afficher une 404
        if (is_null($article)) {
            throw new NotFoundHttpException();
        }

        return $this->render('article_show.html.twig', [
            'article' => $article
        ]);
    }


}
