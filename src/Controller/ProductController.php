<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository $productrepository
     */
    private $productRepository;

    public function __construct(ProductRepository $repository)
    {
        $this->productRepository=$repository;
    }

    /**
     * @Route("/produits/{slug}", name="product")
     * @param $slug
     */
    public function product($slug): Response
    {
        $product=$this->productRepository->findOneBy(['slug'=>$slug]);

        //CrossSelling est un tableau des 4 produits avant celui-là
        $crossSelling = $this->productRepository->findLatestLowerThanId($product->getId());

        return $this->render('product.html.twig', [
            'product' => $product,
            'product_list' => $crossSelling,
        ]);
    }
}
