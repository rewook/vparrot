<?php

namespace App\Controller\Administration;

use App\Entity\Ouverture;
use App\Form\OuvertureType;
use App\Service\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OuvertureController extends AbstractController
{
    #[Route('/admin/ouverture', name: 'app_admin_ouverture')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $ouvertures = $entityManager->getRepository(Ouverture::class)->findAll();
        $horairesOuvertures = $horaires->getHoraires();

        return $this->render('administration/ouverture/index.html.twig', [
            'ouvertures' => $ouvertures,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/ouverture/modif/{id}', name: 'app_admin_modif_ouverture')]
    public function modif($id, EntityManagerInterface $entityManager, Request $request, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();

        $ouverture = $entityManager->getRepository(Ouverture::class)->find($id);

        $form = $this->createForm(OuvertureType::class, $ouverture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ouverture = $form->getData();


            $entityManager->persist($ouverture);
            $entityManager->flush();

            $this->addFlash('success', 'Fiche ouverture modifiée avec succès');

            return $this->redirectToRoute('app_admin_ouverture');

        }

        return $this->render('administration/ouverture/modif.html.twig', [
            'form' => $form->createView(),
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }
}
