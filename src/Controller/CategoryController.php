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
     * @Route("/{slug}", priority=-1, name="category", requirements={"slug":"[a-z]+"})
     * @param $slug
     * @param $productRepository
     * @return Response
     */
    public function category($slug, ProductRepository $productRepository): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug'=>$slug]);

        return $this->render('category.html.twig', [
            'category' => $category,
            'products'=> $productRepository->findBy(['category'=>$category]),
        ]);
    }
}
