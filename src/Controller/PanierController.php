<?php


namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function panier(SessionInterface $session, ProductRepository $productRepository)
    {
        $panier = $session->get('panier', []);

        $panierDonnes = [];

        foreach ($panier as $id => $quantity){
            $panierDonnes[]=[
                    'product' => $productRepository->find($id),
                    'quantity' => $quantity
                ];
        }

        $total = 0;

        foreach ($panierDonnes as $item){
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('panier.html.twig', [
            'items' => $panierDonnes,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="add_panier", requirements={"id": "\d+"})
     */
    public function add($id, SessionInterface $session){

        $panier=$session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id]=1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/panier/remove/{id}", name="remove_panier", requirements={"id": "\d+"})
     */
    public function remove($id, SessionInterface $session){

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/panier/acheter", name="acheter")
     */
    public function acheter(SessionInterface $session){

        $session->set('panier', []);

        $this->addFlash('success','Merci pour votre achat, votre commande a bien été passée !');

        return $this->redirectToRoute('panier', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/panier/vider", name="vider")
     */
    public function vider(SessionInterface $session){

        $session->set('panier', []);

        $this->addFlash('success','Votre panier a été vidé !');

        return $this->redirectToRoute('panier', [], Response::HTTP_SEE_OTHER);
    }
}