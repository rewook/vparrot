<?php

namespace App\Controller\Administration;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Service\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function Sodium\add;

class EquipementController extends AbstractController
{
    #[Route('/admin/equipement', name: 'app_admin_equipement')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();
        // Recherche des equipements par ordre alphabérique
        $repository = $entityManager->getRepository(Equipement::class);
        $qb = $repository->createQueryBuilder('e');
        $qb->orderBy('e.nom', 'ASC');
        $equipements = $qb->getQuery()->getResult();


        return $this->render('administration/equipement/index.html.twig', [
            'equipements' => $equipements,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/equipement/ajout', name: 'app_admin_equipement_ajout')]
    public function ajout(EntityManagerInterface $entityManager, Request $request, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();

        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipement = $form->getData();
            $entityManager->persist($equipement);
            $entityManager->flush();

            $this->addFlash("success", "Equipement ajouté avec succès");

            return $this->redirectToRoute("app_admin_equipement");
        }

        return $this->render('administration/equipement/ajout.html.twig', [
            'form' => $form,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/equipement/modifier/{id}', name: 'app_admin_equipement_modifier')]
    public function modifier(EntityManagerInterface $entityManager, Request $request, $id, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();
        $equipement = $entityManager->getRepository(Equipement::class)->find($id);
        $form = $this->createForm(EquipementType::class, $equipement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipement = $form->getData();
            $entityManager->persist($equipement);
            $entityManager->flush();

            $this->addFlash("success", "Equipement modifié avec succès");

            return $this->redirectToRoute("app_admin_equipement");
        }

        return $this->render('administration/equipement/modifier.html.twig', [
            'form' => $form,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/equipement/suppression/{id}', name: 'app_admin_equipement_suppression')]
    public function supprimer(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $equipement = $entityManager->getRepository(Equipement::class)->find($id);
        $entityManager->remove($equipement);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression de l\'équiment avec succès');

        return $this->redirectToRoute("app_admin_equipement");
    }
}
