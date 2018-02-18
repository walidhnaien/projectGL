<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Jobowner;
use AppBundle\Entity\Freelancer;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //form new freelancer
        $freelancer = new Freelancer();
        $form = $this->createForm('AppBundle\Form\FreelancerType', $freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();

            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPlainPassword($form->get('plainPassword')->getData());
            $user->setEnabled(true);
            $user->addRole('ROLE_FREE');
            //ajout user
            $userManager->updateUser($user);

            $em = $this->getDoctrine()->getManager();

            $freelancer->setUser($user);
            $em->persist($freelancer);
            $em->flush();

            return $this->redirectToRoute('freelancer_show', array('id' => $freelancer->getId()));
        }

        //form new jobowner
        $jobowner = new Jobowner();
        $form_jb = $this->createForm('AppBundle\Form\JobownerType', $jobowner);
        $form_jb->handleRequest($request);

        if ($form_jb->isSubmitted() && $form_jb->isValid()) {

            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();

            $user->setUsername($form_jb->get('username')->getData());
            $user->setEmail($form_jb->get('email')->getData());
            $user->setPlainPassword($form_jb->get('plainPassword')->getData());
            $user->setEnabled(true);
            $user->addRole('ROLE_JOOW');
            //ajout user
            $userManager->updateUser($user);

            $em = $this->getDoctrine()->getManager();

            $jobowner->setUser($user);
            $em->persist($jobowner);
            $em->flush();

            return $this->redirectToRoute('jobowner_show', array('id' => $jobowner->getId()));
        }



        $em = $this->getDoctrine()->getManager();

        $freelancers = $em->getRepository('AppBundle:Freelancer')->findAll();
        $projects = $em->getRepository('AppBundle:Projects')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array('freelancers' => $freelancers,'projects' => $projects,'form_jb' => $form_jb->createView(),'form_free' => $form->createView(),'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR)

        );
    }

}
