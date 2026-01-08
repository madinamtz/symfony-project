<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vinyle')]
final class VinyleController extends AbstractController
{
    #[Route('', name: 'app_vinyle_index', methods: ['GET'])]
    public function index(): Response
    {
        $vinyles = [
            [
                'id' => 1,
                'vinyle' => 'Abbey Road',
                'artiste' => 'The Beatles',
                'annee' => 1969,
                'prix' => 25,
                'description' => 'Album légendaire des Beatles.',
            ],
            [
                'id' => 2,
                'vinyle' => 'Dark Side of the Moon',
                'artiste' => 'Pink Floyd',
                'annee' => 1973,
                'prix' => 30,
                'description' => 'Classique du rock progressif.',
            ],
            [
                'id' => 3,
                'vinyle' => 'Thriller',
                'artiste' => 'Michael Jackson',
                'annee' => 1982,
                'prix' => 28,
                'description' => 'L’album le plus vendu au monde.',
            ],
        ];

        return $this->render('vinyle/index.html.twig', [
            'vinyles' => $vinyles,
        ]);
    }

    #[Route('/{id}', name: 'app_vinyle_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // même tableau hardcodé, indexé par id
        $vinyles = [
            1 => [
                'id' => 1,
                'vinyle' => 'Abbey Road',
                'artiste' => 'The Beatles',
                'annee' => 1969,
                'prix' => 25,
                'description' => 'Album légendaire des Beatles.',
            ],
            2 => [
                'id' => 2,
                'vinyle' => 'Dark Side of the Moon',
                'artiste' => 'Pink Floyd',
                'annee' => 1973,
                'prix' => 30,
                'description' => 'Classique du rock progressif.',
            ],
            3 => [
                'id' => 3,
                'vinyle' => 'Thriller',
                'artiste' => 'Michael Jackson',
                'annee' => 1982,
                'prix' => 28,
                'description' => 'L’album le plus vendu au monde.',
            ],
        ];

        if (!isset($vinyles[$id])) {
            throw $this->createNotFoundException('Vinyle non trouvé.');
        }

        return $this->render('vinyle/show.html.twig', [
            'vinyle' => $vinyles[$id],
        ]);
    }
}
