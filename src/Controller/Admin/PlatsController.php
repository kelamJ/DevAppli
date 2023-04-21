<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
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
    public function add(): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Plat $plat): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    #[Route('/suppression', name: 'delete')]
    public function delete(Plat $plat): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }
}