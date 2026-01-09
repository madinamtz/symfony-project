<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VinyleController extends AbstractController
{
    #[Route('/vinyle', name: 'app_vinyle_index', methods: ['GET'])]
    public function index(): Response
    {
        $vinyles = [
            [
                'id' => 1,
                'vinyle' => 'BALLADS 1',
                'artiste' => 'Joji',
                'annee' => 2020,
                'prix' => 40,
                'description' => 'Album phare de Joji ayant fait propulser sa carrière.',
            ],
            [
                'id' => 2,
                'vinyle' => 'Hit me hard and soft',
                'artiste' => 'Billie Eilish',
                'annee' => 2024,
                'prix' => 30,
                'description' => 'Un des albums les plus populaires de ces dernières années.',
            ],
            [
                'id' => 3,
                'vinyle' => '0.1 flaws and all.',
                'artiste' => 'Wave to Earth',
                'annee' => 2023,
                'prix' => 35,
                'description' => 'Pour une ambiance plus tranquille.',
            ],
        ];

        return $this->render('vinyle/index.html.twig', [
            'vinyles' => $vinyles,
        ]);
    }

    #[Route('/vinyle/{id}', name: 'app_vinyle_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $vinyles = [
            1 => [
                'id' => 1,
                'vinyle' => 'BALLADS 1',
                'artiste' => 'Joji',
                'annee' => 2020,
                'prix' => 40,
                'description' => 'Album phare de Joji ayant fait propulser sa carrière.',
            ],
            2 => [
                'id' => 2,
                'vinyle' => 'Hit me hard and soft',
                'artiste' => 'Billie Eilish',
                'annee' => 2024,
                'prix' => 30,
                'description' => 'Un des albums les plus populaires de ces dernières années.',
            ],
            3 => [
                'id' => 3,
                'vinyle' => '0.1 flaws and all.',
                'artiste' => 'Wave to Earth',
                'annee' => 2023,
                'prix' => 35,
                'description' => 'Pour une ambiance plus tranquille.',
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
