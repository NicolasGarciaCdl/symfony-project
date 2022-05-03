<?php

namespace App\Controller;

use App\Entity\Kind;
use App\Form\KindType;
use App\Repository\KindRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kinds', name: 'app_kinds_')]
class KindController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(KindRepository $kindRepository): Response
    {
        return $this->render('kind/index.html.twig', [
            'kinds' => $kindRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, KindRepository $kindRepository): Response
    {
        $kind = new Kind();
        $form = $this->createForm(KindType::class, $kind);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kindRepository->add($kind);
            return $this->redirectToRoute('app_kinds_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kind/new.html.twig', [
            'kind' => $kind,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Kind $kind): Response
    {
        return $this->render('kind/show.html.twig', [
            'kind' => $kind,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kind $kind, KindRepository $kindRepository): Response
    {
        $form = $this->createForm(KindType::class, $kind);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kindRepository->add($kind);
            return $this->redirectToRoute('app_kinds_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kind/edit.html.twig', [
            'kind' => $kind,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Kind $kind, KindRepository $kindRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kind->getId(), $request->request->get('_token'))) {
            $kindRepository->remove($kind);
        }

        return $this->redirectToRoute('app_kinds_index', [], Response::HTTP_SEE_OTHER);
    }
}
