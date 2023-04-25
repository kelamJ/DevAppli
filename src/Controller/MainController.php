<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategorieRepository $categorieRepository,
    PlatRepository $platRepository
    ): Response
    {
        return $this->render('main/index.html.twig', [
            'categorie' => $categorieRepository->findBy([],
            ['id' => 'asc']),
            'plat' => $platRepository->findBy([],
            ['id' => 'asc'])
        ]);
    }
    
    // #[Route('/{id}', name: 'list')]
    // public function details(Plat $plat): Response
    // {
    //     //On va chercher la liste des plats de la catégorie
    //     $plats = $plat->getPlat();

    //     return $this->render('categorie/list.html.twig', compact(
    //     'categorie',
    //     'plat'));
    // }
}
