<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Service\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $services = $entityManager->getRepository(Service::class)->findAll();
        $horairesOuvertures = $horaires->getHoraires();


        return $this->render('accueil/index.html.twig', [
            'services' => $services,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }
}
