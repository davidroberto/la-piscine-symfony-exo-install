<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{


    /**
     * @Route("/categories", name="categoryList")
     */
    public function categoryList(CategoryRepository $categoryRepository)
    {
        // je dois faire une requête SQL SELECT en bdd
        // sur la table category
        // La classe qui me permet de faire des requêtes SELECT est CategoryRepository
        // donc je dois instancier cette classe
        // pour ça, j'utilise l'autowire (je place la classe en argument du controleur,
        // suivi de la variable dans laquelle je veux que sf m'instancie la classe
        $categories = $categoryRepository->findAll();

        return $this->render('category_list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categoryShow")
     */
    public function categoryShow($id, CategoryRepository $categoryRepository)
    {
        // afficher un category en fonction de l'id renseigné dans l'url (en wildcard)
        $category = $categoryRepository->find($id);

        // si l'category n'a pas été trouvé, je renvoie une exception (erreur)
        // pour afficher une 404
        if (is_null($category)) {
            throw new NotFoundHttpException();
        }

        return $this->render('category_show.html.twig', [
            'category' => $category
        ]);
    }


}
