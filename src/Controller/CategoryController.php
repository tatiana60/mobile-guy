<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $categoryRepository;

    public function __construct(CategoryRepository $repository)
    {
        $this->categoryRepository=$repository;
    }

    /**
     * @Route("/category-{id}", name="category", requirements={"id": "\d+"})
     */
    public function category($id): Response
    {
        $category=$this->categoryRepository->find($id);

        return $this->render('category.html.twig', [
            'category' => $category,
        ]);
    }
}
