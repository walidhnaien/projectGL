<?php

namespace AppBundle\Controller\backoffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Jobowner;

class JobOwnerController extends Controller
{


	/**
     * @Route("/admin/job-owner", name="admin_job_ownwer")
     */
	public function indexAction()
	{

		$em = $this->getDoctrine()->getManager();

		$jobowners = $em->getRepository('AppBundle:Jobowner')->findAll();

		return $this->render('admin/jobowner/index.html.twig', array(
			'jobowners' => $jobowners,
			));
	}
}