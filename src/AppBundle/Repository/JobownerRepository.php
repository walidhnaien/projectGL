<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityManager;

/**
 * JobownerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobownerRepository extends \Doctrine\ORM\EntityRepository
{

	public function sortProjectsByJobOwner() : array
	{

	    $projectsByJobOwner = $this->createQueryBuilder('projects')
							            ->select('jobowner.id, jobowner.socialRaison,jobowner.firstname,jobowner.lastname,count(project.id) as NumberofData')
							            ->from('AppBundle\Entity\Projects','project')
									    ->join('project.jobowner', 'jobowner')
									    ->groupby('jobowner.id')
									    ->orderBy('NumberofData','DESC')
									    ->getQuery()
									    ->getResult();                      
	    return $projectsByJobOwner;     
	}


    public function sortJobOwnerByReputation() : array
    {

     	$jobOwnerByRepution = $this->createQueryBuilder('joeval')
     	                               ->select('jobowner.id, jobowner.socialRaison, jobowner.firstname, jobowner.lastname, COUNT(joeval.mark) AS NumberofData')
     	                               ->from('AppBundle\Entity\Joevaluation','joeval')
     	                               ->join('joeval.jobowner','jobowner')
     	                               ->groupby('jobowner.id')
     	                               ->orderBy('NumberofData','DESC')
     	                               ->getQuery()
     	                               ->getResult();
     	                              
     	return $jobOwnerByRepution;                               
    }
}
