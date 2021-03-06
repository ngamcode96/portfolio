<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Competences;
use App\Entity\Realisation;
use App\Form\CompetenceType;
use App\Form\RealisationType;
use App\Form\UserType;
use App\Repository\CompetencesRepository;
use App\Repository\RealisationRepository;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

        /**
     * @Route("admin/user/{id}/edit", name="user_edit")
     * @Route("admin/user/add", name="user_add")
     */

    public function editUser(User $user = null, Request $request, PersistenceObjectManager $manager, UserPasswordHasherInterface $passwordHasher): Response
    {

        if($user == null){
            $user = new User();
        }
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);



        if($form->isSubmitted()){

            $hash = $passwordHasher->hashPassword($user, $user->getPassword());
          
           $user->setPassword($hash);

           $manager->persist($user);
           $manager->flush();


        }
        
       return $this->render('admin/edit_user.html.twig', [
           'form'=>$form->createView()
       ]);
    }

    /**
     * @Route("/admin/skills_manager", name="skills_manager")
     */

    function getSkills(CompetencesRepository $competencesRepo): Response
    {
        $skills = $competencesRepo->findAll();
        return $this->render("admin/skills.html.twig", [
            'skills'=>$skills
        ]);
    }

     /**
     * @Route("/admin/projects_manager", name="projects_manager")
     */

    function getProjects(RealisationRepository $realisationRepository): Response
    {
        $projects = $realisationRepository->findAll();
        return $this->render("admin/projects.html.twig", [
            'projects'=>$projects
        ]);
    }

     /**
     * @Route("/admin/projects_manager/{id}/edit", name="edit_project")
     * @Route("/admin/projects_manager/new", name="add_new_project")
     */

    public function addOrEditProject(Realisation $project = null, Request $request, PersistenceObjectManager $manager): Response
    {
        

        if($project == null){
            $project = new Realisation();
            $project->setCreatedAt(new \DateTime());
        }

        $form = $this->createForm(RealisationType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isSubmitted()){

            // $image = $form->get('imageLink')->getData();
            // $file_name = md5(uniqid()).'.'.$image->guessExtension();

            // $image->move(
            //     $this->getParameter("images_directory"),
            //     $file_name
            // );

            // $project->setImageLink($file_name);

            $manager->persist($project);
            $manager->flush();
            return $this->redirectToRoute("projects_manager");
        }
        return $this->render("admin/add_edit_project.html.twig", [
            'form'=>$form->createView(),
            'isNew'=>$project->getId() == null,
        ]);
    }

    /**
 * @Route("/admin/skill_manager/{id}/delete", name="delete_project")
 */

 public function delete_project(Realisation $project, PersistenceObjectManager $manager){
    
    
    $manager->remove($project);
    $manager->flush();

    return $this->redirectToRoute("projects_manager");
 }


    /**
     * @Route("/admin/skill_manager/{id}/edit", name="edit_skill")
     * @Route("/admin/skill_manager/new", name="add_new_skill")
     */

    public function addOrEditSkill(Competences $competence = null, Request $request, PersistenceObjectManager $manager): Response
    {
        

        if($competence == null){
            $competence = new Competences();
        }

        $form = $this->createForm(CompetenceType::class, $competence);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($competence);
            $manager->flush();
            return $this->redirectToRoute("skills_manager");
        }
        return $this->render("admin/add_edit_skill.html.twig", [
            'form'=>$form->createView(),
            'isNew'=>$competence->getId() == null,
        ]);
    }

/**
 * @Route("/admin/skill_manager/{id}/delete", name="delete_skill")
 */

 public function delete_skill(Competences $skill, PersistenceObjectManager $manager){
    
    
    $manager->remove($skill);
    $manager->flush();

    return $this->redirectToRoute("skills_manager");
 }
}
