<?php

namespace App\Controller\Administration;

use App\Entity\Service;
use App\Form\EditionServiceType;
use App\Form\ServiceType;
use App\Service\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{
    #[Route('/admin/service', name: 'app_admin_service')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $services = $entityManager->getRepository(Service::class)->findAll();

        return $this->render('administration/service/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/admin/service/ajout', name: 'app_admin_service_ajout')]
    public function ajout(EntityManagerInterface $entityManager,Request $request,ImageService $imageService): Response
    {
        $service= new Service();
        $form = $this->createForm(ServiceType::class,$service);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();
            $imageFile = $form->get('image')->getData();
            if ($imageFile){
                $folder='service';
                $fichier = $imageService->upload($imageFile, $folder, 250, 250);
                $service->setImage($fichier);
            }
            $entityManager->persist($service);

            $entityManager->flush();

            $this->addFlash('success','Nouveau service ajouté avec succés');

            return $this->redirectToRoute('app_admin_service');
        }

        return $this->render('administration/service/ajout.html.twig',[
            'form'=>$form,
        ]);
    }

    #[Route('/admin/service/modification/{id}', name: 'app_admin_service_modification')]
    public function modification($id,EntityManagerInterface $entityManager,Request $request,ImageService $imageService): Response
    {
        $service = $entityManager->getRepository(Service::class)->find($id);
        $form = $this->createForm(EditionServiceType::class,$service);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();
            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash("success","Service modifié avec succès");

            return $this->redirectToRoute("app_admin_service");
        }


        return $this->render('administration/service/modification.html.twig',[
            'form'=> $form,
            'service'=>$service
        ]);

    }

    #[Route('/admin/service/suppression/{id}', name: 'app_admin_service_suppression')]
    public function supprimer(EntityManagerInterface $entityManager,Request $request,$id): Response
    {
        $service = $entityManager->getRepository(Service::class)->find($id);
        $entityManager->remove($service);
        $entityManager->flush();

        $this->addFlash('success','Suppression du service avec succès' );

        return $this->redirectToRoute("app_admin_service");
    }
}
