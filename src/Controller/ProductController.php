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
     * @Route("/product-{id}", name="product")
     * @param $id
     */
    public function product(int $id): Response
    {
        $product=$this->productRepository->find($id);
        return $this->render('product.html.twig', [
            'product' => $product,
        ]);
    }
}
