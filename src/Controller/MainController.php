<?php

namespace App\Controller;

use App\Model\SearchData;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(
        CategorieRepository $categorieRepository,
        PlatRepository $platRepository,
        Request $request
    ): Response
    {
        // $searchData = new SearchData();
        // $form = $this->createForm(SearchType::class, $searchData);
        
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()) {
        //     dd($searchData);
        // }

        return $this->render('main/index.html.twig', [
            // 'form' => $form->createView(),
            'categorie' => $categorieRepository->findBy([],
            ['id' => 'asc']),
            'plat' => $platRepository->findBy([],
            ['id' => 'asc'])
        ]);
    }

    // public function searchBar()
    // {
    //     $form = $this->createFormBuilder()
    //         ->add('query', TextType::class)

    // }
    
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
