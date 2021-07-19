<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function panier()
    {
        return $this->render('panier.html.twig', []);
    }

    /**
     * @Route("/panier/add/{id}", name="add_panier", requirements={"id": "\d+"})
     */
    public function add($id, Request $request){
        $session=$request->getSession();

        $panier=$session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id]=1;
        }

        $session->set('panier', $panier);

        dd($session->get('panier'));
    }

}