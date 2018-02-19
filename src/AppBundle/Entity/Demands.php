<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demands
 *
 * @ORM\Table(name="demands")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandsRepository")
 */
class Demands
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="demandDate", type="date")
     */
    private $demandDate;

    /**
     * @var string
     *
     * @ORM\Column(name="demandstatus", type="string", length=255)
     */
    private $demandstatus;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Jobowner",inversedBy="id")
     * @ORM\JoinColumn(name="jobowner",referencedColumnName="id",onDelete="CASCADE")
     */
    private $jobowner;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDemandDate()
    {
        return $this->demandDate;
    }

    /**
     * @param \DateTime $demandDate
     */
    public function setDemandDate($demandDate)
    {
        $this->demandDate = $demandDate;
    }

    /**
     * @return string
     */
    public function getDemandstatus()
    {
        return $this->demandstatus;
    }

    /**
     * @param string $demandstatus
     */
    public function setDemandstatus($demandstatus)
    {
        $this->demandstatus = $demandstatus;
    }

    /**
     * @return mixed
     */
    public function getJobowner()
    {
        return $this->jobowner;
    }

    /**
     * @param mixed $jobowner
     */
    public function setJobowner($jobowner)
    {
        $this->jobowner = $jobowner;
    }

    /**
     * @return mixed
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * @param mixed $freelancer
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Freelancer",inversedBy="id")
     * @ORM\JoinColumn(name="freelancer",referencedColumnName="id",onDelete="CASCADE")
     */
    private $freelancer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Projects",inversedBy="id")
     * @ORM\JoinColumn(name="project",referencedColumnName="id",onDelete="CASCADE")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


}

