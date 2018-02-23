<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{

	/**
     * @Route("/admin/", name="admin")
     */
	public function AdminHomeAction(Request $request)
	{
		return $this->redirectToRoute('admin_freelancer');   
	}

}
