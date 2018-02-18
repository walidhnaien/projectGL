<?php

namespace AppBundle\Controller\backoffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Projects;


class ProjectController extends Controller
{


	/**
     * @Route("/admin/project", name="admin_project")
     */
	public function indexAction()
	{

		$em = $this->getDoctrine()->getManager();

		$projects = $em->getRepository('AppBundle:Projects')->findAll();

		return $this->render('admin/projects/index.html.twig', array(
			'projects' => $projects,
			));
	}
}