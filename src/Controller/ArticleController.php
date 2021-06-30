<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{

    /**
     * @Route("/articles", name="articles")
     */
    public function articles()
    {
        var_dump('articles');
    }

}
