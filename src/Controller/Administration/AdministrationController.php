<?php

namespace App\Controller\Administration;

use App\Entity\Contact;
use App\Service\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdministrationController extends AbstractController
{
    #[Route('/admin', name: 'app_administration')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $contacts = $entityManager->getRepository(Contact::class)->findBy(['estRappele' => false]);
        $horairesOuvertures = $horaires->getHoraires();


        return $this->render('administration/index.html.twig', [
            'contacts' => $contacts,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }
}
