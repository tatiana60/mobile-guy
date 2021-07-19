<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
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
     * @param $id
     * @param $productRepository
     * @return Response
     */
    public function category(int $id, ProductRepository $productRepository): Response
    {
        $category=$this->categoryRepository->find($id);

        return $this->render('category.html.twig', [
            'category' => $category,
            'products'=> $productRepository->findAll(),
        ]);
    }
}
