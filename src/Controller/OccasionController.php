<?php

namespace App\Controller;

use App\Entity\Vehicule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class OccasionController extends AbstractController
{
    #[Route('/occasion', name: 'app_occasion')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $occasions= $entityManager->getRepository(Vehicule::class)->findAll();

        return $this->render('occasion/index.html.twig',[
            'occasions'=> $occasions
        ]);
    }
}
