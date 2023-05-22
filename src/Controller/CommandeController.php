<?php

namespace App\Controller;

use App\Entity\Detail;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/commande/payer', name: 'com_index')]
    public function index(CartService $cartService): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);
        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }

    #[Route('/commande/verifier', name: 'com_verif')]
    public function verifCom(CartService $cartService, Request $request): Response
    {
        $form = $this->createForm(CommandeType::class, null,[
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $datetime = new \DateTime('now');
            $transporter = $form->get('transporter')->getData();
            $delivery = $form->get('addresses')->getData();
            $deliveryForCom = $delivery->getPrenom() . ' ' . $delivery->getNom();
            $deliveryForCom .= '</br>' . $delivery->getPhone();
            if($delivery->getCompany()){
                $deliveryForCom .= ' - ' . $delivery->getCompany();
            }
            $deliveryForCom .= '</br>' . $delivery->getAdress();
            $deliveryForCom .= '</br>' . $delivery->getPostalcode() . ' - ' . $delivery->getCity();
            $deliveryForCom .= '</br>' . $delivery->getCountry();
            $commande = new Commande();
            $reference = $datetime->format('dmY').'-'.uniqid();
            $commande->setUtilisateur($this->getUser());
            $commande->setReference($reference);
            $commande->setDateCommande($datetime);
            $commande->setDelivery($deliveryForCom);
            $commande->setTransporterName($transporter->getTitle());
            $commande->setTransporterPrice($transporter->getPrice());
            $commande->setIsPaid(0);
            $commande->setMethod('stripe');

            $this->em->persist($commande);

            

            foreach ($cartService->getTotal() as $plat)
            {
                $details = new Detail();
                $details->setCommande($commande);
                $details->setQuantite();

            }
            
        }
        return $this->render('commande/recap.html.twig');
    }

}
