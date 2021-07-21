<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function category($slug, ProductRepository $productRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Product::class)->findBy([],['id' => 'desc']);

        $products = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),12
        );

        $category = $this->categoryRepository->findOneBy(['slug'=>$slug]);

        return $this->render('category.html.twig', [
            'category' => $category,
            'products'=> $productRepository->findBy(['category'=>$category]),
            'page_products' => $products,
        ]);
    }
}
