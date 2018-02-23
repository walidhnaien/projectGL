<?php

namespace AppBundle\Controller\backoffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Freelancer;

class FreelancerController extends Controller
{


	/**
     * @Route("/admin/freelancer", name="admin_freelancer")
     */
	public function indexAction(Request $request)
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
			->orWhere('f.address LIKE :address')
			->setParameter('skills', '%'.$search.'%')
			->setParameter('address', '%'.$search.'%')
			->getQuery()
			->getResult();
		}
		return $this->render('admin/freelancers/index.html.twig', array(
			'freelancers' => $freelancers,
			));
	}
}
