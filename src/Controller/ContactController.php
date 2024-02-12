<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $contact->setEstRappele(false);

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success','Votre formulaire a été soumis avec succès');

            return $this->redirectToRoute('app_accueil');

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/contact/{id}', name: 'app_admin_contact_rappele')]
    public function rappelle($id,EntityManagerInterface $entityManager): Response
    {
        $contact = $entityManager->getRepository(Contact::class)->find($id);

        $contact->setEstRappele(true);
        $entityManager->persist($contact);
        $entityManager->flush();

        $this->addFlash("success","Le contact a été rappelé");

        return $this->redirectToRoute('app_administration');

    }


}
