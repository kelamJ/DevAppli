<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plat', name: 'plat_')]

class PlatController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PlatRepository $platRepository): Response
    {
        return $this->render('plat/index.html.twig', [
            'plat' => $platRepository->findBy([],
            ['id' => 'asc'])
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(Plat $plat): Response
    {
        return $this->render('plat/details.html.twig', compact('plat'));
    }
}
