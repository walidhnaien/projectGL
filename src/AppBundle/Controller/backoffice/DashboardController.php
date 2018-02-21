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

        $jobownerRepository = new JobownerRepository($em);
        $projectsByJobOwner = $jobownerRepository->sortProjectsByJobOwner();
        // fix relationship between Joevaluation & JobOwner inside Joevaluation
        //$jobOwnerByReputition = $jobownerRepository->sortJobOwnerByReputition();


        $freelancerRepository = new FreelancerRepository($em);
        $freelancersByAcceptedProject = $freelancerRepository->sortFreelancersByAcceptedProjects();
         // fix relationship between flevaluation & freelancer inside flevaluation
        //$freelancersByReputation = $freelancerRepository->sortFreelancerByReputation();



        $chartProjectsJobowner = $this->getProjectsJobownerChart('Job Owner By Projects', $projectsByJobOwner);
       // $chartJobOwnerByReputition = $this->getProjectsJobownerChart('Job Owner By Reputition', $jobOwnerByReputition);
        //$chartFreelancersByAcceptedProject = $this->getProjectsJobownerChart('Freelancers By Projects', $freelancersByAcceptedProject);
        //$chartFreelancersByReputation = $this->getProjectsJobownerChart('Freelancers By Reputation', $freelancersByReputation); 


        return $this->render('admin/dashboard/index.html.twig', 
                    array(
                            'chartProjectsJobowner' => $chartProjectsJobowner,
                            //'chartJobOwnerByReputition' => $chartJobOwnerByReputition,
                            //'chartFreelancersByAcceptedProject' => $chartFreelancersByAcceptedProject,
                            //'chartFreelancersByReputation'      => $chartFreelancersByReputation
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