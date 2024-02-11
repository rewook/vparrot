<?php

namespace App\Controller;

use App\Entity\Ouverture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OuvertureController extends AbstractController
{
    #[Route('/admin/ouverture', name: 'app_admin_ouverture')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ouvertures= $entityManager->getRepository(Ouverture::class)->findAll();

        return $this->render('administration/ouverture/index.html.twig', [
            'ouvertures' => $ouvertures
        ]);
    }
}
