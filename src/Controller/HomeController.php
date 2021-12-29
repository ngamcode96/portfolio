<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\ContactType;
use App\Repository\CompetencesRepository;
use App\Repository\RealisationRepository;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository, RealisationRepository $realisationRepository, CompetencesRepository $competencesRepository, Request $request): Response
    {
        $user = $userRepository->findAll(); 
        $realisations = $realisationRepository->findAll(); 
        $competences = $competencesRepository->findAll();

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact->setCreatedAt(new \DateTime());
            dump($contact);
            die();
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user[0],
            'realisations'=>$realisations,
            'competences'=>$competences,
            'form'=>$form->createView()
        ]);
    }
}
