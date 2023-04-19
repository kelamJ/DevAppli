<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categorie', name: 'categorie_')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorieRepository->findBy([],
            ['id' => 'asc'])
        ]);
    }

    #[Route('/{id}', name: 'list')]
    public function details(Categorie $categorie): Response
    {
        //On va chercher la liste des plats de la catégorie
        $plat = $categorie->getPlats();

        return $this->render('categorie/list.html.twig', compact(
        'categorie',
        'plat'));
    }
}
