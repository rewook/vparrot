<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Service\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class OccasionController extends AbstractController
{
    #[Route('/occasion', name: 'app_occasion')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $occasions = $entityManager->getRepository(Vehicule::class)->findAll();
        $horairesOuvertures = $horaires->getHoraires();

        return $this->render('occasion/index.html.twig', [
            'occasions' => $occasions,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }
}
