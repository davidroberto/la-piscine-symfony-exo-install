<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Tag;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticleController extends AbstractController
{

    /**
     * @Route("/admin/articles/insert", name="admin_article_insert")
     */
    public function insertArticle(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $article = new Article();

        // on génère le formulaire en utilisant le gabarit + une instance de l'entité Article
        $articleForm = $this->createForm(ArticleType::class, $article);

        // on lie le formulaire aux données de POST (aux données envoyées en POST)
        $articleForm->handleRequest($request);

        // si le formulaire a été posté et qu'il est valide (que tous les champs
        // obligatoires sont remplis correctement), alors on enregistre l'article
        // créé en bdd
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {

            // je récupère l'image uploadée par l'utilisateur
            $imageFile = $articleForm->get('image')->getData();

            if ($imageFile) {

                // je créé un nom unique avec le nom original de l'image
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // je "slugifie" le nom original de l'image
                $safeFilename = $slugger->slug($originalFilename);
                // j'ajoute un id unique au nom de l'image
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // je déplace l'image uploadée dans le dossier public/uploads/article (et je la renomme)
                // idéalement avec un block de try and catch
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                // j'ajoute l'image dans l'entité article (avec le setter)
                $article->setImage($newFilename);
            }

            // permet de stocker en session un message flash, dans le but de l'afficher
            // sur la page suivante
            $this->addFlash(
                'success',
                'L\'article '. $article->getTitle().' a bien été créé !'
            );

            // je persiste l'article en bdd
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/admin_insert.html.twig', [
           'articleForm' => $articleForm->createView()
        ]);
    }


    /**
     * @Route("/admin/articles/update/{id}", name="admin_article_update")
     */
    public function updateArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, Request $request)
    {
        // pour l'insert : $article = new Article();
        $article = $articleRepository->find($id);

        // on génère le formulaire en utilisant le gabarit + une instance de l'entité Article
        $articleForm = $this->createForm(ArticleType::class, $article);

        // on lie le formulaire aux données de POST (aux données envoyées en POST)
        $articleForm->handleRequest($request);

        // si le formulaire a été posté et qu'il est valide (que tous les champs
        // obligatoires sont remplis correctement), alors on enregistre l'article
        // créé en bdd
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/admin_insert.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_article_delete")
     */
    public function deleteArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'L\'article '. $article->getTitle().' a bien été supprimé !'
        );

        return $this->redirectToRoute("admin_article_list");
    }

    /**
     * @Route("/admin/articles", name="admin_article_list")
     */
    public function articleList(ArticleRepository $articleRepository)
    {
        // je dois faire une requête SQL SELECT en bdd
        // sur la table article
        // La classe qui me permet de faire des requêtes SELECT est ArticleRepository
        // donc je dois instancier cette classe
        // pour ça, j'utilise l'autowire (je place la classe en argument du controleur,
        $articles = $articleRepository->findAll();

        return $this->render('admin/admin_article_list.html.twig', [
            'articles' => $articles
        ]);
    }

}
