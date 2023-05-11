<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    #[Route('/panier', name: 'cart_index')]
    public function index(CartService $cartService): Response
    {

        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getTotal()
        ]);
    }

    #[Route('/panier/add/{id<\d+>}', name: 'cart_add')]
    public function addToCart(
        CartService $cartService,
        Plat $plat 
        ): Response
    {
        $cartService->addToCart($plat->getId());
        
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/panier/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeTocart(
        CartService $cartService,
        Plat $plat 
        ): Response
    {
        $cartService->removeTocart($plat->getId());
        
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/panier/removeAll', name: 'cart_removeAll')]
    public function removeAll(CartService $cartService): Response
    {
        $cartService->removeCartAll();
        
        return $this->redirectToRoute('cart_index');
    }
}
