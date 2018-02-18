<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Freelancer;
use AppBundle\Entity\Jobowner;
use AppBundle\Entity\Projects;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Freelancer controller.
 *
 * @Route("freelancer")
 */
class FreelancerController extends Controller
{
    /**
     * home  freelancer .
     *
     * @Route("/home", name="freelancer_home")
     *
     */
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ps = $em->getRepository('AppBundle:Projects')->findAll();
        /*
        $free= new Freelancer();
        $job = new Jobowner();
        $form = $this->createForm('AppBundle\Form\FreelancerType', $free);
        $form2 = $this->createForm('AppBundle\Form\JobownerType', $job);*/
        return $this->render('freelancer/home.html.twig', array(
            'projects' => $ps
        ));
    }
    /**
     * Lists all freelancer entities.
     *
     * @Route("/", name="freelancer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $freelancers = $em->getRepository('AppBundle:Freelancer')->findAll();

        return $this->render('freelancer/index.html.twig', array(
            'freelancers' => $freelancers,
        ));
    }

    /**
     * Creates a new freelancer entity.
     *
     * @Route("/new", name="freelancer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
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

        return $this->render('freelancer/new.html.twig', array(
            'freelancer' => $freelancer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_show")
     * @Method("GET")
     */
    public function showAction(Freelancer $freelancer)
    {
        $deleteForm = $this->createDeleteForm($freelancer);

        return $this->render('freelancer/show.html.twig', array(
            'freelancer' => $freelancer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing freelancer entity.
     *
     * @Route("/{id}/edit", name="freelancer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Freelancer $freelancer)
    {
        $user = $freelancer->getUser();
        $freelancer->setEmail($user->getEmail());
        $freelancer->setUsername($user->getUsername());
        $freelancer->setPlainPassword($user->getPlainPassword());
        $deleteForm = $this->createDeleteForm($freelancer);
        $editForm = $this->createForm('AppBundle\Form\FreelancerType', $freelancer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('freelancer_edit', array('id' => $freelancer->getId()));
        }

        return $this->render('freelancer/edit.html.twig', array(
            'freelancer' => $freelancer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Freelancer $freelancer)
    {
        $form = $this->createDeleteForm($freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($freelancer);
            $em->flush();
        }

        return $this->redirectToRoute('freelancer_index');
    }

    /**
     * Creates a form to delete a freelancer entity.
     *
     * @param Freelancer $freelancer The freelancer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Freelancer $freelancer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('freelancer_delete', array('id' => $freelancer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
