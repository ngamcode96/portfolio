<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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
    public function index(UserRepository $userRepository, RealisationRepository $realisationRepository, CompetencesRepository $competencesRepository, Request $request, MailerInterface $mailer): Response
    {
        $user = $userRepository->findAll(); 
        $realisations = $realisationRepository->findAll(); 
        $competences = $competencesRepository->findAll();

        $contact = new Contact();
       

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

    

        if($form->isSubmitted() && $form->isValid()){
            $contact->setCreatedAt(new \DateTime());
        
            $email_html = '<div style="margin:10px;padding:10pxl font-family: verdana">
	
            <h3 style="color: #001478; text-align: center; margin-top:20px;">Message de '.$contact->getName().'</h3>
            <h4 style="color: #001478; text-align: center; margin-top:20px;">Expediteur: <a style="text-decoration:none" href="mailto:'.$contact->getSender().'">'.$contact->getSender().'</h4>
            <div>
                    <p style="padding: 20px; font-size: 18px; font-family: verdana">'.$contact->getMessage().'</p>
                    
                    <p style="padding: 10px; font-size: 18px; font-family: verdana">Envoyé le '.$contact->getCreatedAt()->format('d/m/Y').'</p>
            </div>
            
        </div>
        ';

            $mail = (new Email())
            ->from('contact@ngamcode.com')
            ->to('ngamcode@gmail.com')
            ->subject('Nouveau message sur ton portfolio')
            ->html($email_html)
         ;
            $mailer->send($mail);

            $this->addFlash('success', 'Votre message a été envoyé avec succès! Merci');
        }

        return $this->render('home/index.html.twig', [
            'user' => $user[0],
            'realisations'=>$realisations,
            'competences'=>$competences,
            'form'=>$form->createView()
        ]);
    }

}
