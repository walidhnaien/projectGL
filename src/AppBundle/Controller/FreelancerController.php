<?php

namespace AppBundle\Controller;
use Doctrine\DBAL\Cache\ResultCacheStatement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Freelancer;
use AppBundle\Form\FreelancerType;
use AppBundle\Entity\Jobowner;
use AppBundle\Entity\Projects;
use AppBundle\Entity\Flevaluation;
use AppBundle\Form\FlevaluationType;

/**
 * Freelancer controller.
 *
 * @Route("freelancer")
 */
class FreelancerController extends Controller
{

    public function __construct()
    {

    }



    /**
     * rating a new freelancer entity.
     *
     * @Route("/rating", name="freelancer_rating")
     */
    public function ratingAction(Request $request)
    {

        $freelancer_evaluation_form = $this->createForm('AppBundle\Form\FlevaluationType');
        $freelancer_evaluation_form->handleRequest($request);
        
        if ($freelancer_evaluation_form->isSubmitted() && $freelancer_evaluation_form->isValid()) {

            $freelancerEvaluation = new Flevaluation();
            /*
            $freelancer = new Freelancer();
            $freelancer->setId($request->get('freelancer_id'));
            $freelancerEvaluation->setFreelancer($freelancer); 
            */
            $freelancerEvaluation->setMark($request->get('rating'));
            $freelancerEvaluation->setJobowner($request->get('jobowner_id'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($freelancerEvaluation);
            $em->flush();

            return $this->redirectToRoute('freelancer_rating');          
        }
          

        return $this->render('freelancer/rating.html.twig', array(
            'freelancer_evaluation_form' => $freelancer_evaluation_form->createView()
        ));
    }



    /**
     *
     * @Route("/edit", name="freelancer_edit")
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $freelancers = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        $freelancer = new Freelancer();
        foreach($freelancers as $f){
            $freelancer = $f;
        }

        $editForm = $this->createForm('AppBundle\Form\FreelancerType', $freelancer);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $user->setEmail($user->getEmail());
            $user->setUsername($user->getUsername());
            $user->setPlainPassword($user->getPlainPassword());
            //$deleteForm = $this->createDeleteForm($freelancer);
            $userManager->updateUser($user);
            $em->flush();

            return $this->redirectToRoute('freelancer_edit');
        }

        return $this->render('freelancer/edit.html.twig', array(
            'edit_form' => $editForm->createView(),

        ));
    }
    /**
     * home  freelancer .
     *
     * @Route("/home", name="freelancer_home")
     *
     */
    public function homeAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $ps = $em->getRepository('AppBundle:Projects')->findAll();
        $user = $this->getUser();
        $freelancers = $em->getRepository('AppBundle:Freelancer')->findBy(array("user"=>$user));
        $freelancer = new Freelancer();
        foreach($freelancers as $f){
            $freelancer = $f;
        }

        $demands = $em->getRepository('AppBundle:Demands')->findBy(array("freelancer"=>$freelancer));
        if($request->get('search') == NULL)
        {
            $ps = $em->getRepository('AppBundle:Projects')->findAll();
        }
        else
        {
            $search = $request->get('search');

            $ps = $em->getRepository("AppBundle:Projects")->createQueryBuilder('p')
                ->where('p.activityarea LIKE :activityarea')
                ->orWhere('p.requiredskills LIKE :requiredskills')
                ->setParameter('activityarea', '%'.$search.'%')
                ->setParameter('requiredskills','%'.$search.'%')
                ->getQuery()
                ->getResult();
        }

        /*
        $free= new Freelancer();
        $job = new Jobowner();
        $form = $this->createForm('AppBundle\Form\FreelancerType', $free);
        $form2 = $this->createForm('AppBundle\Form\JobownerType', $job);*/
        return $this->render('freelancer/home.html.twig', array(
            'projects' => $ps,'demandes'=>$demands,
        ));
    }
    /**
     * Lists all freelancer entities.
     *
     * @Route("/", name="freelancer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $freelancers = $em->getRepository('AppBundle:Freelancer')->findAll();

        return $this->render('freelancer/index.html.twig', array(
            'freelancers' => $freelancers,
        ));
    }

    /**
     * Creates a new freelancer entity.
     *
     * @Route("/new", name="freelancer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $freelancer = new Freelancer();
        $form = $this->createForm('AppBundle\Form\FreelancerType', $freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();

            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPlainPassword($form->get('plainPassword')->getData());
            $user->setEnabled(true);
            $user->addRole('ROLE_FREE');
            //ajout user
            $userManager->updateUser($user);

            $em = $this->getDoctrine()->getManager();

            $freelancer->setUser($user);
            $em->persist($freelancer);
            $em->flush();

            return $this->redirectToRoute('freelancer_show', array('id' => $freelancer->getId()));
        }

        return $this->render('freelancer/new.html.twig', array(
            'freelancer' => $freelancer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_show")
     * @Method("GET")
     */
    public function showAction(Freelancer $freelancer)
    {
        $deleteForm = $this->createDeleteForm($freelancer);

        return $this->render('freelancer/show.html.twig', array(
            'freelancer' => $freelancer,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Deletes a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Freelancer $freelancer)
    {
        $form = $this->createDeleteForm($freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($freelancer);
            $em->flush();
        }

        return $this->redirectToRoute('freelancer_index');
    }

    /**
     * Creates a form to delete a freelancer entity.
     *
     * @param Freelancer $freelancer The freelancer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Freelancer $freelancer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('freelancer_delete', array('id' => $freelancer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
