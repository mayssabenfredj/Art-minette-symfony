<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailController extends AbstractController
{
    #[Route('/detail/{id}', name: 'app_detail')]
    public function index(int $id ,ProduitRepository $productRepository): Response
    {
        return $this->render('detail/index.html.twig', [
            'product' => $productRepository->find($id),
        ]);
    }
}