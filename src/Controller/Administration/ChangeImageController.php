<?php

namespace App\Controller\Administration;

use App\Entity\Vehicule;
use App\Form\ChangeImageType;
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
    public function index($id,EntityManagerInterface $entityManager,Request $request): Response
    {



        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);

        $form = $this->createForm(ChangeImageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager= new ImageManager(Driver::class);
            $imageFile = $form->get('image')->getData();



            // Vérifier si un fichier a été téléchargé
            if ($imageFile) {
                // Générer un nom de fichier unique
                $newFilename = uniqid().'.'.$imageFile->guessExtension();


                // Déplacer le fichier téléchargé vers le répertoire souhaité
                try {
                    $imageFile->move(
                        $this->getParameter('uploads_directory'), // Répertoire de destination (défini dans services.yaml)
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si le déplacement échoue
                    // ...
                }

                // Mettre à jour le nom du fichier dans l'entité Vehicle
                $vehicule->setImage($newFilename);

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
