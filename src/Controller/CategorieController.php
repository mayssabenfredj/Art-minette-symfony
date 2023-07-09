<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(ProduitRepository $productRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'products' => $productRepository->findBy(['name' => 'Keyboard']),
        ]);
    }
}
