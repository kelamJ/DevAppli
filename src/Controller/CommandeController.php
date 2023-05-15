<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'payer')]
    public function index(CartService $cart): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'cart'=>$cart
        ]);
    }
}
