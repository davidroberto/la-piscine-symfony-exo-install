<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
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
     *
     * j'utilise "l'autowire" pour instancier automatiquement
     * la classe Request dans la variable $request
     * Pour faire ça, je mets la variable $request en param
     * de ma méthode, précédé de la classe
     */
    public function contact(Request $request)
    {
        // je stocke dans une variable $request la valeur
        // du parametre GET 'sent'
        $sent = $request->query->get('sent');

        // si le parametre GET 'sent' est égal à 'yes' alors j'envoie
        // une réponse avec 'merci pour le form'
        if ($sent === 'yes') {
            return new Response("merci pour le formulaire");
        // sinon je renvoie le formulaire en réponse
        } else {
            return new Response("formulaire");
        }

    }

    /**
     * @Route("/poker", name="poker")
     */
    public function poker()
    {
       $request = Request::createFromGlobals();

       $age = $request->query->get('age');

       if ($age > 18) {
           return new Response('Poker blablab');
       } else {
           // je fais une redirection vers la route digimon
           // grâce à la méthode redirectToRoute qui existe dans
           // l'AbstractController
           // Ma classe PageController hérite d'AbstractController
           // donc elle hérite aussi de la méthode redirectToRoute
           return $this->redirectToRoute('digimon');
       }
    }

    /**
     * @Route("/digimon", name="digimon")
     */
    public function digimon()
    {
        return new Response("Les digimons");
    }

}
