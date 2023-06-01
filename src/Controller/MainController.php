<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/index', name: 'main_')]
class MainController extends AbstractController
{
    
    #[Route('/', name: 'index')]
    public function index(
        CategorieRepository $categorieRepository,
        PlatRepository $platRepository
    ): Response
    {
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl(route:'main_handleSearch'))
            ->add('query', TextType::class, [
                'attr' => [
                    'class' => 'w-100'
                ],
                'label' => 'Vous chercher quelque chose ?'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-secondary'
                ],
                'label' => 'Rechercher'
            ])
            ->getForm()
            ;

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'categorie' => $categorieRepository->findBy([],
            ['id' => 'asc']),
            'plat' => $platRepository->findBy([],
            ['id' => 'asc'])
        ]);

        
    }

    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(
    Request $request,
    CategorieRepository $categorieRepository,
    PlatRepository $platRepository)
    {
        $query = $request->request->all('form')['query'];
        if ($query) {
            $categories = $categorieRepository->findByExampleField($query);
            $plats = $platRepository->findByExampleField($query);
        }

        dump($plats); die;

        // return $this->render('search/result/', [
        //     'categories' => $categories,
        //     'plats' => $plats
        // ]);
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
