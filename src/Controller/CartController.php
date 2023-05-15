<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/panier/payer}', name: 'cart_buy')]
    public function payer(
        CartService $cartService,
        Plat $plat 
        ): Response
    {
        
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/panier/decrease/{id<\d+>}', name: 'cart_decrease')]
    public function decrease(
        CartService $cartService,
        Plat $plat 
        ): RedirectResponse
    {
        $cartService->decrease($plat->getId());
        
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
