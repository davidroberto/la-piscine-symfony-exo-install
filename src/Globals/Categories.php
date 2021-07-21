<?php


namespace App\Globals;


use App\Repository\CategoryRepository;

class Categories
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $categories = $this->categoryRepository->findAll();

        return $categories;
    }

}
