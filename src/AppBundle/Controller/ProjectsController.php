<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Examen;
use AppBundle\Entity\Freelancer;
use AppBundle\Entity\Projects;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 * @Route("projects")
 */
class ProjectsController extends Controller
{
    /**
     * Lists all project entities.
     *
     * @Route("/", name="projects_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AppBundle:Projects')->findAll();

        return $this->render('projects/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="projects_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Projects();
        $form = $this->createForm('AppBundle\Form\ProjectsType', $project);
        $form->handleRequest($request);
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('AppBundle:Jobowner')->findBy(array("user"=>$user));
        foreach ($jobs as $j){
            $job = $j;
        }
        $project->setJobowner($job);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('projects_show', array('id' => $project->getId()));
        }

        return $this->render('projects/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{id}", name="projects_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Projects')->find($id);
        $deleteForm = $this->createDeleteForm($project);

        $user = $this->getUser();

        $free = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        $freelancer = new Freelancer();
        foreach ($free as $freel){
            $freelancer = $freel;
        }

        $exs = $em->getRepository('AppBundle:Examen')->findBy(array("project"=>$project));
        $examen = new Examen();
        foreach($exs as $e){
            $examen = $e;
        }



        $test = $this->getDoctrine()
            ->getRepository('AppBundle:Tests')
            ->findBy(array('freelancer' => $freelancer,'examen'=>$examen));

        $nb = count($test);


        return $this->render('projects/show.html.twig', array(
            'project' => $project,'examen'=>$examen,'test' => $nb,'free'=>$freelancer,'project'=>$project,'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/detail/{id}", name="projects_display")
     * @Method("GET")
     */
    public function displayAction(Projects $project,$id)
    {
        $deleteForm = $this->createDeleteForm($project);
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Projects')->find($id);




        return $this->render('projects/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="projects_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projects $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectsType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jobowner_home', array('id' => $project->getId()));
        }

        return $this->render('projects/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="projects_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projects $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('projects_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Projects $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projects $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projects_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
