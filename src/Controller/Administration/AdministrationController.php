<?php

namespace App\Controller\Administration;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdministrationController extends AbstractController
{
    #[Route('/admin', name: 'app_administration')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $contacts = $entityManager->getRepository(Contact::class)->findBy(['estRappele'=>false]);




        return $this->render('administration/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
