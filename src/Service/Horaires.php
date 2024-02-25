<?php

namespace App\Service;

use App\Repository\OuvertureRepository;

class Horaires
{
    private $ouvertureRepository;

    public function __construct(OuvertureRepository $ouvertureRepository)
    {
        $this->ouvertureRepository = $ouvertureRepository;
    }

    public function getHoraires(): array
    {
// Récupére les horaires d'ouverture depuis le repository
        return $this->ouvertureRepository->findAll();
    }
}