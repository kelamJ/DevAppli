<?php

namespace App\Controller\Admin;

use App\Entity\Adress;
use App\Form\AdressType;
use App\Repository\UserRepository;
use App\Repository\AdressRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/utilisateurs', name: 'admin_users_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['prenom' =>
        'asc']);

        return $this->render('admin/user/index.html.twig', compact('users'));
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adress $adress, AdressRepository $adressRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adressRepository->save($adress, true);

            return $this->redirectToRoute('admin_trans_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/adress/edit.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }


    #[Route('/gestion', name: 'gestion')]
    public function gestion(AdressRepository $adressRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $adresses = $adressRepository->findBy([], ['id' =>
        'asc']);

        return $this->render('admin/user/gestion.html.twig', compact('adresses'));
    }
}