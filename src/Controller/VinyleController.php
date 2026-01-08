<?php

namespace App\Controller;

use App\Entity\Vinyle;
use App\Form\VinyleType;
use App\Repository\VinyleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vinyle')]
final class VinyleController extends AbstractController
{
    #[Route(name: 'app_vinyle_index', methods: ['GET'])]
    public function index(VinyleRepository $vinyleRepository): Response
    {
        return $this->render('vinyle/index.html.twig', [
            'vinyles' => $vinyleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vinyle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vinyle = new Vinyle();
        $form = $this->createForm(VinyleType::class, $vinyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vinyle);
            $entityManager->flush();

            return $this->redirectToRoute('app_vinyle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vinyle/new.html.twig', [
            'vinyle' => $vinyle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vinyle_show', methods: ['GET'])]
    public function show(Vinyle $vinyle): Response
    {
        return $this->render('vinyle/show.html.twig', [
            'vinyle' => $vinyle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vinyle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vinyle $vinyle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VinyleType::class, $vinyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vinyle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vinyle/edit.html.twig', [
            'vinyle' => $vinyle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vinyle_delete', methods: ['POST'])]
    public function delete(Request $request, Vinyle $vinyle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vinyle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vinyle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vinyle_index', [], Response::HTTP_SEE_OTHER);
    }
}
