<?php

namespace App\Controller\Admin;

use App\Entity\Transporter;
use App\Form\TransporterType;
use App\Repository\TransporterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/transporter', name: 'admin_trans_')]
class TransporterController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(TransporterRepository $transporterRepository): Response
    {
        return $this->render('transporter/index.html.twig', [
            'transporters' => $transporterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, TransporterRepository $transporterRepository): Response
    {
        $transporter = new Transporter();
        $form = $this->createForm(TransporterType::class, $transporter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporterRepository->save($transporter, true);

            return $this->redirectToRoute('admin_trans_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transporter/new.html.twig', [
            'transporter' => $transporter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Transporter $transporter): Response
    {
        return $this->render('transporter/show.html.twig', [
            'transporter' => $transporter,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transporter $transporter, TransporterRepository $transporterRepository): Response
    {
        $form = $this->createForm(TransporterType::class, $transporter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transporterRepository->save($transporter, true);

            return $this->redirectToRoute('admin_trans_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transporter/edit.html.twig', [
            'transporter' => $transporter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Transporter $transporter, TransporterRepository $transporterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transporter->getId(), $request->request->get('_token'))) {
            $transporterRepository->remove($transporter, true);
        }

        return $this->redirectToRoute('admin_trans_index', [], Response::HTTP_SEE_OTHER);
    }
}
