<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Equipement;
use App\Entity\Ouverture;
use App\Entity\Service;
use App\Entity\Utilisateur;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use function Symfony\Component\Clock\now;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //admin de la plateforme
        $admin = new Utilisateur();
        $admin->setNom('Parrot')
            ->setPrenom('Vincent')
            ->setEmail('admin@test.com')
            ->setPassword('12$Stl54')
            ->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);

        //employé
        $employe = new Utilisateur();
        $employe->setNom('Doe')
            ->setPrenom('John')
            ->setEmail('j.doe@test.com')
            ->setRoles('[ROLE_USER')
            ->setPassword('12$Stl54');

        $manager->persist($employe);

        //Création de service
        for ($i = 0; $i < 4; $i++) {
            $service = new Service();
            $imageNom = $faker->word . '.jpg';
            $service->setNom($faker->company)
                ->setDescription($faker->sentence(20, true))
                ->setImage('/uploads/service/mini/' . $imageNom);
            $manager->persist($service);
        }

        //création de commentaires
        for ($i = 0; $i < 6; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setNom($faker->userName)
                ->setCommentaire($faker->sentence(15, true))
                ->setCreation($faker->date('d-m-Y', max: now()))
                ->setEstHumain(1)
                ->setEstModere(rand(0, 1))
                ->setNote(random_int(1, 5));

            $manager->persist($commentaire);

        }

        // création de contacts
        for ($i = 0; $i < 6; $i++) {
            $contact = new Contact();
            $contact->setNom($faker->userName)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setMessage($faker->sentence(10, true))
                ->setTelephone($faker->phoneNumber)
                ->setEstHumain(1)
                ->setEstRappele(rand(0, 1));

            $manager->persist($contact);

        }

        //création des équipements
        for ($i = 0; $i < 4; $i++) {
            $equipement = new Equipement();
            $equipement->setNom($faker->word);

            $manager->persist($equipement);
        }

        //création des heures d'ouverture
        $ouverture1 = new Ouverture();
        $ouverture1->setJour('LUNDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time('14:00:00'))
            ->setHfapresmidi(time('18:00:00'));
        $manager->persist($ouverture1);
        $ouverture2 = new Ouverture();
        $ouverture2->setJour('MARDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time('14:00:00'))
            ->setHfapresmidi(time('18:00:00'));
        $manager->persist($ouverture2);
        $ouverture3 = new Ouverture();
        $ouverture3->setJour('MERCREDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time('14:00:00'))
            ->setHfapresmidi(time('18:00:00'));
        $manager->persist($ouverture3);
        $ouverture4 = new Ouverture();
        $ouverture4->setJour('JEUDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time('14:00:00'))
            ->setHfapresmidi(time('18:00:00'));
        $manager->persist($ouverture4);
        $ouverture5 = new Ouverture();
        $ouverture5->setJour('VENDREDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time('14:00:00'))
            ->setHfapresmidi(time('18:00:00'));
        $manager->persist($ouverture5);
        $ouverture6 = new Ouverture();
        $ouverture6->setJour('SAMEDI')
            ->setHdmatin(time('08:45:00'))
            ->setHfmatin(time('12:00:00'))
            ->setHdapresmidi(time(null))
            ->setHfapresmidi(time(null));
        $manager->persist($ouverture6);
        $ouverture7 = new Ouverture();
        $ouverture7->setJour('DIMANCHE')
            ->setHdmatin(time('null'))
            ->setHfmatin(time('null'))
            ->setHdapresmidi(time('null'))
            ->setHfapresmidi(time('null'));
        $manager->persist($ouverture7);

        //création des équipements
        for ($i = 0; $i < 4; $i++) {
            $vehicule = new Vehicule();
            $imageVehicule = $faker->word . '.jpg';
            $energiepossible = ['ESSENCE', 'GASOIL', 'ELECTRIQUE', 'GPL'];
            $vehicule->setTitre($faker->sentence(3, true))
                ->setPrix($faker->numberBetween(2000, 30000))
                ->setImage('/uploads/vehicule/mini/' . $imageVehicule)
                ->setNbporte($faker->numberBetween(3, 5))
                ->setMarque($faker->company)
                ->setModele($faker->company)
                ->setAnnee($faker->numberBetween(2015, 2024))
                ->setKilometrage($faker->numberBetween(1000, 250000))
                ->setEnergie(array_rand($energiepossible))
                ->setBoite($faker->numberBetween(4, 6))
                ->setCouleur($faker->colorName)
                ->setNbplace($faker->numberBetween(3, 7))
                ->setPuissance($faker->numberBetween(5, 11))
                ->setPuissanceDin($faker->numberBetween(150, 220))
                ->addEquipement($equipement);

            $manager->persist($vehicule);
        }


        $manager->flush();
    }
}
