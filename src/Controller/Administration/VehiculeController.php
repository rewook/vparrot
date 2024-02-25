<?php

namespace App\Controller\Administration;

use App\Entity\Vehicule;
use App\Form\EditionVehiculeType;
use App\Form\VehiculeType;
use App\Service\Horaires;
use App\Service\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VehiculeController extends AbstractController
{
    #[Route('/admin/vehicule', name: 'app_admin_vehicule')]
    public function index(EntityManagerInterface $entityManager, Horaires $horaires): Response
    {
        $vehicules = $entityManager->getRepository(Vehicule::class)->findAll();
        $horairesOuvertures = $horaires->getHoraires();


        return $this->render('administration/vehicule/index.html.twig', [
            'vehicules' => $vehicules,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/vehicule/ajout', name: 'app_admin_vehicule_ajout')]
    public function ajout(EntityManagerInterface $entityManager, Request $request, ImageService $imageService, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();

        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $folder = 'vehicule';
                $fichier = $imageService->upload($imageFile, $folder, 150, 150);
                $vehicule->setImage($fichier);
            }

            $entityManager->persist($vehicule);

            $entityManager->flush();

            $this->addFlash('success', 'Véhicule d\'occasion ajouté avec succés');

            return $this->redirectToRoute('app_admin_vehicule');
        }

        return $this->render('administration/vehicule/ajout.html.twig', [
            'form' => $form,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/vehicule/modification/{id}', name: 'app_admin_vehicule_modification')]
    public function modification($id, EntityManagerInterface $entityManager, Request $request, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();

        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);

        $form = $this->createForm(EditionVehiculeType::class, $vehicule);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicule = $form->getData();

            $entityManager->persist($vehicule);

            $entityManager->flush();

            $this->addFlash('success', 'Véhicule d\'occasion modifié avec succés');

            return $this->redirectToRoute('app_admin_vehicule');
        }

        return $this->render('administration/vehicule/modification.html.twig', [
            'form' => $form,
            'vehicule' => $vehicule,
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }

    #[Route('/admin/vehicule/suppression/{id}', name: 'app_admin_vehicule_suppression')]
    public function supprimer(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);
        $entityManager->remove($vehicule);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression du véhicule d\'occasion avec succès');

        return $this->redirectToRoute("app_admin_vehicule");
    }

}
