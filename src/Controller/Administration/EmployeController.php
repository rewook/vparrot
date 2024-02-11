<?php

namespace App\Controller\Administration;

use App\Entity\Utilisateur;
use App\Form\AjoutEmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class EmployeController extends AbstractController
{
    private function genererMotDePasseAleatoire($longueur = 10)
    {
        $caracteresPermis = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$!#';
        $motDePasse = '';
        for ($i = 0; $i < $longueur; $i++) {
            $motDePasse .= $caracteresPermis[rand(0, strlen($caracteresPermis) - 1)];
        }
        return $motDePasse;
    }
    #[Route('/admin/employe', name: 'app_admin_employe')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $employes = $entityManager->getRepository(Utilisateur::class)->findByRoles('ROLE_EMPLOYE');



        return $this->render('administration/employe/index.html.twig', [
            'employes' => $employes,
        ]);
    }

    #[Route('/admin/employe/ajout', name: 'app_admin_employe_ajout')]
    public function ajout(EntityManagerInterface $entityManager, Request $request,UserPasswordHasherInterface $passwordHasher): Response
    {
        $employe = new Utilisateur();

        $form = $this->createForm(AjoutEmployeType::class,$employe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $employe = $form->getData();
            $employe->setRoles(["ROLE_EMPLOYE"]);

            // Générer un mot de passe aléatoire
            $plaintextPassword = $this->genererMotDePasseAleatoire();



            // Chiffrer le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($employe, $plaintextPassword);


            $employe->setPassword($hashedPassword);

            $entityManager->persist($employe);
            $entityManager->flush();

            $this->addFlash('success','Employé ajouté avec succès');

            return $this->redirectToRoute('app_admin_employe');
        }

        return $this->render('administration/employe/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/admin/employe/edition/{id}', name: 'app_admin_employe_edition')]
    public function edition($id,EntityManagerInterface $entityManager, Request $request): Response
    {
        $employe = $entityManager->getRepository(Utilisateur::class)->find($id);

        $form = $this->createForm(AjoutEmployeType::class, $employe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employe = $form->getData();

            $entityManager->persist($employe);
            $entityManager->flush();

            $this->addFlash('success','Fiche employé modifiée avec succès');

            return $this->redirectToRoute('app_admin_employe');

        }

        return $this->render('administration/employe/edition.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/admin/employe/suppression/{id}', name: 'app_admin_employe_suppression')]
    public function suppression($id,EntityManagerInterface $entityManager, Request $request): Response
    {
        $employe = $entityManager->getRepository(Utilisateur::class)->find($id);

        $entityManager->remove($employe);
        $entityManager->flush();

        $this->addFlash('success','Fiche employé supprimée avec succès');

        return $this->redirectToRoute('app_admin_employe');
    }
}
