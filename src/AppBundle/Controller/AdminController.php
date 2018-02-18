<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{


	/**
     * @Route("/login/admin", name="admin_login_form")
     */
	public function loginAdminAction(Request $request)
	{
		$csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;


		return $this->render('admin/login.html.twig',array(
            'csrf_token' => $csrfToken,
        ));
	}


	/**
     * @Route("/home", name="admin_home")
     */
	public function indexAction()
	{

		  return $this->render('admin/index.html.twig');

	}

}
