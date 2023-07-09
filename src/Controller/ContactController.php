<?php

namespace App\Controller;

use App\Entity\Contact;

use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request , ManagerRegistry $doctrine)
    {
    {
        $contact = new Contact();
    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $contact = $form->getData();
       
    
    $entityManager = $doctrine->getManager();
    $entityManager->persist($contact);
    $entityManager->flush();
    //return $this->redirectToRoute('confirm');
    }
    return $this->render('contact/index.html.twig', ['form' => $form->createView(),]);
    }
    }
}
