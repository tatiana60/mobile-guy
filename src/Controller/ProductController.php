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

    /**
     * @Route("/product", name="product")
     */
    public function product(): Response
    {
        return $this->render('product.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

}
