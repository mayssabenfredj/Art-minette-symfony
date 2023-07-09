<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AfficherProduitController extends AbstractController
{
    #[Route('/list_prod', name: 'app_list/prod')]
    public function index(ProduitRepository $productRepository): Response
    {
        return $this->render('afficher_produit/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}

