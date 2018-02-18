<?php

namespace AppBundle\Controller\backoffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{


	/**
     * @Route("/home/dashboard", name="admin_dashboard")
     */
	public function indexAction()
	{

		  return $this->render('admin/dashboard/index.html.twig');

	}
}