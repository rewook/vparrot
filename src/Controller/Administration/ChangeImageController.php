<?php

namespace App\Controller\Administration;

use App\Entity\Vehicule;
use App\Form\ChangeImageType;
use App\Service\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChangeImageController extends AbstractController
{
    #[Route('admin/change/image/{id}', name: 'app_admin_change_image')]
    public function index($id,EntityManagerInterface $entityManager,Request $request,ImageService $imageService): Response
    {



        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);

        $form = $this->createForm(ChangeImageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager= new ImageManager(Driver::class);
            $imageFile = $form->get('image')->getData();



            // Vérifier si un fichier a été téléchargé
            if ($imageFile) {
                $folder='vehicule';
                $fichier = $imageService->upload($imageFile, $folder, 200, 200);


                // Mettre à jour le nom du fichier dans l'entité Vehicle
                $vehicule->setImage($fichier);

                $entityManager->persist($vehicule);
                $entityManager->flush();

                $this->addFlash('success','Image modifiée avec succés');

                return $this->redirectToRoute('app_admin_vehicule_modification',['id'=>$vehicule->getId()]);
            }
        }

        return $this->render('administration/change_image/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
