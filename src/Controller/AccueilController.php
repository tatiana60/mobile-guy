<?php


namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @var ProductRepository $productrepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {

        //CrossSelling est un tableau des 4 produits avant celui-là
        $nouveaute = $this->productRepository->findLatest();

        return $this->render('accueil.html.twig', [
            'product_list' => $nouveaute,
        ]);
    }
}