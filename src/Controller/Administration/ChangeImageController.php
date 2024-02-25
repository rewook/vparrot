<?php

namespace App\Controller\Administration;

use App\Entity\Service;
use App\Entity\Vehicule;
use App\Form\ChangeImageType;
use App\Service\Horaires;
use App\Service\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function Symfony\Component\String\b;

class ChangeImageController extends AbstractController
{
    #[Route('admin/change/image/{id}/{type}', name: 'app_admin_change_image')]
    public function index($id, $type, EntityManagerInterface $entityManager, Request $request, ImageService $imageService, Horaires $horaires): Response
    {
        $horairesOuvertures = $horaires->getHoraires();

        switch ($type) {
            case 'vehicule':
                $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);
                break;
            case 'service':
                $service = $entityManager->getRepository(Service::class)->find($id);
                break;
        }


        $form = $this->createForm(ChangeImageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager = new ImageManager(Driver::class);
            $imageFile = $form->get('image')->getData();


            // Vérifier si un fichier a été téléchargé
            if ($imageFile) {
                switch ($type) {
                    case 'vehicule':
                        $folder = 'vehicule';
                        break;
                    case 'service':
                        $folder = 'service';
                        break;
                }

                $fichier = $imageService->upload($imageFile, $folder, 150, 150);


                // Mettre à jour le nom du fichier dans l'entité
                switch ($type) {
                    case 'vehicule':
                        $vehicule->setImage($fichier);

                        $entityManager->persist($vehicule);
                        $entityManager->flush();

                        $this->addFlash('success', 'Image modifiée avec succés');

                        return $this->redirectToRoute('app_admin_vehicule_modification', ['id' => $vehicule->getId()]);
                        break;
                    case 'service':
                        $service->setImage($fichier);

                        $entityManager->persist($service);
                        $entityManager->flush();

                        $this->addFlash('success', 'Image modifiée avec succés');
                        return $this->redirectToRoute('app_admin_service_modification', ['id' => $service->getId()]);
                }

            }
        }

        return $this->render('administration/change_image/index.html.twig', [
            'form' => $form->createView(),
            'horairesOuvertures' => $horairesOuvertures
        ]);
    }


}
