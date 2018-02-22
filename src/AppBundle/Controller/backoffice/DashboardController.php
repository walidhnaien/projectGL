<?php

namespace AppBundle\Controller\backoffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use AppBundle\Repository\JobownerRepository;
use AppBundle\Repository\FreelancerRepository;

class DashboardController extends Controller
{


	/**
     * @Route("admin/home/dashboard", name="admin_dashboard")
     */
	public function indexAction()
	{

        $em = $this->getDoctrine()->getManager();

        $projectsByJobOwner = $em->getRepository('AppBundle:Jobowner')->sortProjectsByJobOwner();
        $jobOwnerByReputition  = $em->createQuery('SELECT jobowner.id, jobowner.socialRaison, jobowner.firstname, COUNT(joevaluation.mark) AS NumberofData 
                      FROM AppBundle\Entity\Joevaluation joevaluation  JOIN joevaluation.jobowner jobowner GROUP BY jobowner.id ORDER BY NumberofData DESC')->getResult();


        $freelancersByAcceptedProject = $em->createQuery('SELECT freelancer.firstname,freelancer.lastname,COUNT(demands.id) as NumberofData from AppBundle\Entity\Demands demands
                                     JOIN demands.freelancer freelancer  WHERE  demands.demandstatus = 1 GROUP BY freelancer.id ORDER BY NumberofData DESC')->getResult();

        $freelancersByReputation = $em->createQuery('SELECT freelancer.id,freelancer.firstname,freelancer.lastname,COUNT(flevaluation.mark) AS NumberofData from AppBundle\Entity\Flevaluation  flevaluation JOIN flevaluation.freelancer freelancer  GROUP BY freelancer.id ORDER BY NumberofData DESC')->getResult();



        $chartProjectsJobowner             = $this->getProjectsJobownerChart('Job Owner By Projects', $projectsByJobOwner);
        $chartJobOwnerByReputation         = $this->getProjectsJobownerChart('Job Owner By Reputition', $jobOwnerByReputition);
        $chartFreelancersByAcceptedProject = $this->getProjectsJobownerChart('Freelancers By Projects', $freelancersByAcceptedProject);
        $chartFreelancersByReputation      = $this->getProjectsJobownerChart('Freelancers By Reputation', $freelancersByReputation); 

        return $this->render('admin/dashboard/index.html.twig', 
                    array(
                            'chartProjectsJobowner' => $chartProjectsJobowner,
                            'chartJobOwnerByReputation' => $chartJobOwnerByReputation,
                            'chartFreelancersByAcceptedProject' => $chartFreelancersByAcceptedProject,
                            'chartFreelancersByReputation'      => $chartFreelancersByReputation
                        ));

	}


    private function getProjectsJobownerChart($titleChart, $dataCollection): PieChart
    {
        $chartCollection = [];
        array_push($chartCollection,['','']);

        foreach($dataCollection as $data){
            array_push($chartCollection,[$data['firstname'].' '.$data['lastname'],intval($data['NumberofData'])]);
        }


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
              $chartCollection
        );
        $pieChart->getOptions()->setTitle($titleChart);
        $pieChart->getOptions()->setHeight(350);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $pieChart;

    }
}