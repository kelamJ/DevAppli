<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\PlatsFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/plats', name: 'admin_plats_')]
class PlatsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(
        Request $request,
        EntityManagerInterface $em,
        PictureService $pictureService
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée un "nouveau plat"
        $plat = new Plat();

        // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

        // On traite la requête du formulaire
        $platForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if($platForm->isSubmitted() && $platForm->isValid()){
            // On récupère les images
            $images = $platForm->get('image')->getData();

            foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'plats';

                // On apelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);
                
                // $img = new Image();
                // $img->setName($fichier);
            }
            // On arrondit le prix
            // $prix = $plat->getPrix() * 100;
            // $plat->setPrix($prix);

            // On stocke
            $em->persist($plat);
            $em->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');

            //On redirige
            return $this->redirectToRoute('admin_plats_index');
        }

        return $this->render('admin/plats/add.html.twig', [
            'platForm' => $platForm->createView()
        ]);

        // return $this->renderForm('admin/plats/add.html.twig', compact('platForm'));
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(
    Plat $plat,
    Request $request,
    EntityManagerInterface $em
    ): Response
    {
        // On vérifie si l'utilisateur peut éditer avec le voter 
        $this->denyAccessUnlessGranted('PLAT_EDIT', $plat);

         // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

         // On traite la requête du formulaire
        $platForm->handleRequest($request);

         // On vérifie si le formulaire est soumis et valide
        if($platForm->isSubmitted() && $platForm->isValid()){
             // On arrondit le prix
             // $prix = $plat->getPrix() * 100;
             // $plat->setPrix($prix);

             // On stocke
            $em->persist($plat);
            $em->flush();

            $this->addFlash('success', 'Produit modifié avec succès');

             //On redirige
            return $this->redirectToRoute('admin_plats_index');
        }

        return $this->render('admin/plats/edit.html.twig', [
            'platForm' => $platForm->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Plat $plat): Response
    {
        // On vérifie si l'utilisateur peut supprimer avec le voter
        $this->denyAccessUnlessGranted('PLAT_DELETE', $plat);

        return $this->render('admin/plats/index.html.twig');
    }
}