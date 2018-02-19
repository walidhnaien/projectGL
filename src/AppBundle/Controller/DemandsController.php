<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Demands;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demand controller.
 *
 * @Route("demands")
 */
class DemandsController extends Controller
{
    /**
     * Lists all demand entities.
     *
     * @Route("/", name="demands_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demands = $em->getRepository('AppBundle:Demands')->findAll();

        return $this->render('demands/index.html.twig', array(
            'demands' => $demands,
        ));
    }

    /**
     * Lists all demand entities.
     *
     * @Route("/demandByProject/{id}", name="demandByProject_index")
     * @Method("GET")
     */
    public function demandByProjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Projects')->find($id);
        $demands = $em->getRepository('AppBundle:Demands')->findBy(array("project"=>$project));

        return $this->render('demands/index.html.twig', array(
            'demands' => $demands,
        ));
    }


    /**
     * Lists all demand entities.
     *
     * @Route("/demandByFreelancer/{id}", name="demandByFreelancer_index")
     * @Method("GET")
     */
    public function demandByFreelancerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $freelancers = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        $freelancer = new Freelancer();
        foreach($freelancers as $f){
            $freelancer = $f;
        }

        $demands = $em->getRepository('AppBundle:Demands')->findBy(array("freelancer"=>$freelancer));

        return $this->render('freelancer/home.html.twig', array(
            'demandes' => $demands
        ));
    }





    /**
     * Creates a new demand entity.
     *
     * @Route("/new/{id}", name="demands_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $freelancer = $em->getRepository('AppBundle:Freelancer')->find($id);
        $demand = new Demands();
        $form = $this->createForm('AppBundle\Form\DemandsType', $demand);
        $form->handleRequest($request);
        $demand->setFreelancer($freelancer);

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('AppBundle:Jobowner')->findBy(array("user"=>$user));
        foreach ($jobs as $j){
            $job = $j;
        }
        $demand->setJobowner($job);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demand);
            $em->flush();

            return $this->redirectToRoute('demands_show', array('id' => $demand->getId()));
        }

        return $this->render('demands/new.html.twig', array(
            'demand' => $demand,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/add/{id}", name="demands_add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $freelancer = $em->getRepository('AppBundle:Projects')->find($id);
        $demand = new Demands();
        $form = $this->createForm('AppBundle\Form\DemandsType', $demand);
        $form->handleRequest($request);
        $demand->setProject($freelancer);

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        foreach ($jobs as $j){
            $job = $j;
        }
        $demand->setFreelancer($job);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demand);
            $em->flush();

            return $this->redirectToRoute('demands_show', array('id' => $demand->getId()));
        }

        return $this->render('demands/new.html.twig', array(
            'demand' => $demand,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demand entity.
     *
     * @Route("/{id}", name="demands_show")
     * @Method("GET")
     */
    public function showAction(Demands $demand)
    {
        $deleteForm = $this->createDeleteForm($demand);

        return $this->render('demands/show.html.twig', array(
            'demand' => $demand,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing demand entity.
     *
     * @Route("/{id}/edit", name="demands_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demands $demand)
    {
        $deleteForm = $this->createDeleteForm($demand);
        $editForm = $this->createForm('AppBundle\Form\DemandsType', $demand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demands_edit', array('id' => $demand->getId()));
        }

        return $this->render('demands/edit.html.twig', array(
            'demand' => $demand,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demand entity.
     *
     * @Route("/{id}", name="demands_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demands $demand)
    {
        $form = $this->createDeleteForm($demand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demand);
            $em->flush();
        }

        return $this->redirectToRoute('demands_index');
    }

    /**
     * Creates a form to delete a demand entity.
     *
     * @param Demands $demand The demand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demands $demand)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demands_delete', array('id' => $demand->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
