<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategoriesFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/categories', name: 'admin_categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/categories/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(
        Request $request,
        EntityManagerInterface $em,
        PictureService $pictureService
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée une "nouvelle catégorie"
        $cat = new Categorie();

        // On crée le formulaire
        $catForm = $this->createForm(CategoriesFormType::class, $cat);

        // On traite la requête du formulaire
        $catForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if($catForm->isSubmitted() && $catForm->isValid()){
            // On récupère les images
            $images = $catForm->get('image')->getData();

            foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'categories';

                // On apelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);
                
                // $img = new Image();
                $cat->setImage($fichier);
            }
            // On arrondit le prix
            // $prix = $plat->getPrix() * 100;
            // $plat->setPrix($prix);

            // On stocke
            $em->persist($cat);
            $em->flush();

            $this->addFlash('success', 'Catégorie ajouté avec succès');

            //On redirige
            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/categories/add.html.twig', [
            'catForm' => $catForm->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(
    Categorie $cat,
    Request $request,
    EntityManagerInterface $em
    ): Response
    {
        // On vérifie si l'utilisateur peut éditer avec le voter 
        $this->denyAccessUnlessGranted('CAT_EDIT', $cat);

         // On crée le formulaire
        $catForm = $this->createForm(CategoriesFormType::class, $cat);

         // On traite la requête du formulaire
        $catForm->handleRequest($request);

         // On vérifie si le formulaire est soumis et valide
        if($catForm->isSubmitted() && $catForm->isValid()){
             // On arrondit le prix
             // $prix = $plat->getPrix() * 100;
             // $plat->setPrix($prix);

             // On stocke
            $em->persist($cat);
            $em->flush();

            $this->addFlash('success', 'Catégorie modifié avec succès');

             //On redirige
            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'catForm' => $catForm->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Categorie $cat): Response
    {
        // On vérifie si l'utilisateur peut supprimer avec le voter
        $this->denyAccessUnlessGranted('CAT_DELETE', $cat);

        return $this->render('admin/categories/index.html.twig');
    }
}