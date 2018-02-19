<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Jobowner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jobowner controller.
 *
 * @Route("jobowner")
 */
class JobownerController extends Controller
{
    /**
     * home jobowner entities.
     *
     * @Route("/home", name="jobowner_home")
     */
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->get('search') == NULL)
        {
            $freelancers = $em->getRepository('AppBundle:Freelancer')->findAll();
        }
        else
        {
            $search = $request->get('search');

            $freelancers = $em->getRepository("AppBundle:Freelancer")->createQueryBuilder('f')
                ->where('f.skills LIKE :skills')
                ->orWhere('f.disponible LIKE :disponible')
                ->setParameter('skills', '%'.$search.'%')
                ->setParameter('disponible','%'.$search.'%')
                ->getQuery()
                ->getResult();
            //var_dump($freelancers);
        }


        $user = $this->getUser();

        $jobs = $em->getRepository('AppBundle:Jobowner')->findBy(array("user"=>$user));
        foreach ($jobs as $j){
            $job = $j;
        }
        $ps = $em->getRepository('AppBundle:Projects')->findBy(array("jobowner"=>$j));
        return $this->render('jobowner/home.html.twig', array(
            'frees' => $freelancers,'job'=>$job,'projects'=>$ps
        ));
    }
    /**
     * Lists all jobowner entities.
     *
     * @Route("/", name="jobowner_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobowners = $em->getRepository('AppBundle:Jobowner')->findAll();

        return $this->render('jobowner/index.html.twig', array(
            'jobowners' => $jobowners,
        ));
    }

    /**
     * Creates a new jobowner entity.
     *
     * @Route("/new", name="jobowner_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jobowner = new Jobowner();
        $form = $this->createForm('AppBundle\Form\JobownerType', $jobowner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();

            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPlainPassword($form->get('plainPassword')->getData());
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

        return $this->render('jobowner/new.html.twig', array(
            'jobowner' => $jobowner,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jobowner entity.
     *
     * @Route("/{id}", name="jobowner_show")
     * @Method("GET")
     */
    public function showAction(Jobowner $jobowner)
    {
        $deleteForm = $this->createDeleteForm($jobowner);

        return $this->render('jobowner/show.html.twig', array(
            'jobowner' => $jobowner,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jobowner entity.
     *
     * @Route("/{id}/edit", name="jobowner_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Jobowner $jobowner)
    {
        $user = $jobowner->getUser();
        $jobowner->setEmail($user->getEmail());
        $jobowner->setUsername($user->getUsername());
        $jobowner->setPlainPassword($user->getPlainPassword());
        $deleteForm = $this->createDeleteForm($jobowner);

        $editForm = $this->createForm('AppBundle\Form\JobownerType', $jobowner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jobowner_edit', array('id' => $jobowner->getId()));
        }

        return $this->render('jobowner/edit.html.twig', array(
            'jobowner' => $jobowner,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jobowner entity.
     *
     * @Route("/{id}", name="jobowner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Jobowner $jobowner)
    {
        $form = $this->createDeleteForm($jobowner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobowner);
            $em->flush();
        }

        return $this->redirectToRoute('jobowner_index');
    }

    /**
     * Creates a form to delete a jobowner entity.
     *
     * @param Jobowner $jobowner The jobowner entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jobowner $jobowner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobowner_delete', array('id' => $jobowner->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
