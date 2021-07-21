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

    /**
     * @Route("/cgv", name="cgv")
     */
    public function conditionsVente():Response
    {
        return $this->render('cgv.html.twig');
    }

    /**
     * @Route("/cookies", name="cookies")
     */
    public function cookies():Response
    {
        return $this->render('cookies.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function mentions():Response
    {
        return $this->render('mentions_legales.html.twig');
    }

    /**
     * @Route("/protection-donnees", name="protection_donnees")
     */
    public function protection():Response
    {
        return $this->render('protection_donnees.html.twig');
    }
}