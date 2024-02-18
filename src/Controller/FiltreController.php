<?php

namespace App\Controller;

use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FiltreController extends AbstractController
{
    #[Route('/filtreprix', name: 'filtre_prix',methods: 'POST')]
    public function filtrerVehiculesParPrix(Request $request,VehiculeRepository $repository): Response
    {

        if ($request->isXmlHttpRequest()) {
            $type = $request->request->get('type');

            $prixMin = $request->request->get('minPrix');
            $prixMax = $request->request->get('maxPrix');

            $kilometreMin = $request->request->get('minKilometre');
            $kilometreMax = $request->request->get('maxKilometre');

            $anneeMin = $request->request->get('minAnnee');
            $anneeMax = $request->request->get('maxAnnee');


            $resultatsFiltres = $repository->findVehicules($prixMin,$prixMax,$kilometreMin,$kilometreMax,$anneeMin,$anneeMax);


            $occasions=[];
            foreach ($resultatsFiltres as $resultatsFiltre){
                $occasions[] = [
                    'id' => $resultatsFiltre->getId(),
                    'titre'=> $resultatsFiltre->getTitre(),
                    'imageocc'=> '/uploads/vehicule/mini/'.$resultatsFiltre->getImage(),
                    'prix' => $resultatsFiltre->getPrix(),
                    'annee'=> $resultatsFiltre->getAnnee(),
                    'kilometrage' => $resultatsFiltre->getKilometrage()
                ];
            }

            // (par exemple, en utilisant Doctrine pour interroger la base de données)
            // Retournez les résultats au format JSON
            return new JsonResponse(['occasions'=>$occasions]);

        }
        throw new BadRequestHttpException('Requête incorrecte');

    }
}
