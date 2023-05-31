<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_index')]
    public function index(
        Request $request,
        EntityManagerInterface $manager
        ): Response
    {
        $contact = new Contact();

        if ($this->getUser()) {
            $contact->setNom($this->getUser()->getNom())
                    ->setPrenom($this->getUser()->getPrenom())
                    ->setEmail($this->getUser()->getEmail());
        }
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);

            $manager->flush();

            $this->addFlash('success', 'Votre demande de contact a été envoyé avec succès');
            
            return $this->redirectToRoute('contact_index');    
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
