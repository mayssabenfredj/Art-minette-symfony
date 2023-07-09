<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class CartController extends AbstractController
{
   
    #[Route('/cart', name: 'app_cart')]
    public function index(ManagerRegistry $doctrine,SessionInterface $session , ProduitRepository $productRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierData = [];
        foreach ($panier as $id => $quantity){
            $panierData[] =[
                'product'=>  $doctrine->getRepository(Produit::class)->find($id),
                'quantity' => $quantity
            ] ;}
            $total = 0;
            foreach ($panierData as $item) {
                $totalItem = $item['product']->getPrice() * $item['quantity'];
                $total += $totalItem;
            }
        
      
        return $this->render('cart/index.html.twig', [
            'items'=> $panierData ,
            'total' => $total,
            
        ]);
    }
    /**
     * @Route("cart/add/{id}", name="cart_add")
     */
    public function add(int $id, SessionInterface $session)
    {
        $panier = $session->get('panier', []); 
        if (!empty($panier[$id]))
            $panier[$id]++;
        else
            $panier[$id] = 1;
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_cart');
    }
    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove(int $id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart');
    }
     /**
     * @Route("/cart/remove", name="cart_removeall")
     */
    public function removeall(SessionInterface $session)
    {
      $session->clear();
         
            
         
        

        return $this->redirectToRoute('app_cart');
    }
}
