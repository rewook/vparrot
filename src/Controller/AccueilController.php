<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $services= $entityManager->getRepository(Service::class)->findAll();

        return $this->render('accueil/index.html.twig',[
            'services'=> $services
        ]);
    }
}
