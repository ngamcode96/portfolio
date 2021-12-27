<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\RealisationRepository;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository, RealisationRepository $realisationRepository, CompetencesRepository $competencesRepository): Response
    {
        $user = $userRepository->findAll(); 
        $realisations = $realisationRepository->findAll(); 
        $competences = $competencesRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user[0],
            'realisations'=>$realisations,
            'competences'=>$competences
        ]);
    }
}
