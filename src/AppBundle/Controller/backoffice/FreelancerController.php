<?php

namespace AppBundle\Controller\backoffice;
use AppBundle\Repository\FreelancerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Freelancer;

class FreelancerController extends Controller
{
	/**
     * @Route("/home/freelancer", name="admin_freelancer")
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
                ->where('f.nameofcolumn = :email')
                ->andWhere('f.Product LIKE :product')
                ->setParameter('email', 'some@mail.com')
                ->setParameter('product', 'My Products%')
                ->getQuery()
                ->getResult();
            var_dump($freelancers);
        }


        return $this->render('admin/freelancers/index.html.twig', array(
			'freelancers' => $freelancers,
			));
	}
}