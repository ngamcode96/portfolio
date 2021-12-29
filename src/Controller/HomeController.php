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
    public function index(Contact $contact = null, UserRepository $userRepository, RealisationRepository $realisationRepository, CompetencesRepository $competencesRepository, Request $request): Response
    {
        $user = $userRepository->findAll(); 
        $realisations = $realisationRepository->findAll(); 
        $competences = $competencesRepository->findAll();

        if($contact == null){
            $contact = new Contact();
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        $mail = (new Email())->from('contact@ngamcode.com')
                            ->to('amadoungam18@gmail.com')
                            ->subject("Bonjour cc")
                            ->html("<h3>Premier message a partir de symfony</h3>", 'text/html');
        

        
        





        if($form->isSubmitted() && $form->isValid()){
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

     /**
    * @Route("/mail", name="email")
    */
   public function sendMail(MailerInterface $mailer)
   {
      // ...

      $mail = (new Email())
         ->from('amadoungam18@gmail.com')
         ->to('contact@ngamcode.com')
         ->subject('Mon beau sujet')
         ->html('<p>Ceci est mon message en HTML</p>')
      ;

      $mailer->send($mail);

      // ...
   }
}
