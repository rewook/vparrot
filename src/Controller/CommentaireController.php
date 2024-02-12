<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $commentaires = $entityManager->getRepository(Commentaire::class)->findBy(['estModere'=>true]);

        return $this->render('commentaire/index.html.twig',[
            'commentaires'=>$commentaires
        ]);



    }

    #[Route('/commentaire/ajout', name: 'app_commentaire_ajout')]
    public function ajout(Request $request,EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$commentaire);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();

            $jour=new \DateTime();


            $commentaire->setEstModere(false);
            $commentaire->setCreation($jour);

            $entityManager->persist($commentaire);

            $entityManager->flush();

            $this->addFlash('success','Votre commentaire a été soumis avec succès');

            return $this->redirectToRoute('app_accueil');

        }


        return $this->render('commentaire/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/commentaire', name: 'app_admin_commentaire')]
    public function liste(Request $request,EntityManagerInterface $entityManager): Response
    {
        $commentaires = $entityManager->getRepository(Commentaire::class)->findAll();


        return $this->render('administration/commentaire/liste.html.twig',[
            'commentaires' => $commentaires
        ]);

    }

    #[Route('/admin/commentaire/modere/{id}', name: 'app_admin_commentaire_modere')]
    public function modere($id,Request $request,EntityManagerInterface $entityManager): Response
    {
        $commentaire= $entityManager->getRepository(Commentaire::class)->find($id);
        $employe= $this->getUser();

        $commentaire->setEstModere(true);
        $commentaire->setUtilisateurId($employe);
        $entityManager->persist($commentaire);
        $entityManager->flush();

        $this->addFlash("success","Le commentaire est modéré");

        return $this->redirectToRoute('app_admin_commentaire');
    }

    #[Route('/admin/commentaire/supprimer/{id}', name: 'app_admin_commentaire_supprimer')]
    public function supprimer($id,Request $request,EntityManagerInterface $entityManager): Response
    {
        $commentaire=$entityManager->getRepository(Commentaire::class)->find($id);

        $entityManager->remove($commentaire);
        $entityManager->flush();

        $this->addFlash('success','Commentaire supprimé avec succès');

        return $this->redirectToRoute('app_admin_commentaire');
    }

}
