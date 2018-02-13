<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectsRepository")
 */
class Projects
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
     * @var string
     *
     * @ORM\Column(name="projectName", type="string", length=255)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="activityarea", type="string", length=255)
     */
    private $activityarea;

    /**
     * @var string
     *
     * @ORM\Column(name="projectdescription", type="string", length=255)
     */
    private $projectdescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255)
     */
    private $payment;

    /**
     * @var int
     *
     * @ORM\Column(name="experiencelevel", type="integer")
     */
    private $experiencelevel;

    /**
     * @var string
     *
     * @ORM\Column(name="requiredskills", type="string", length=255)
     */
    private $requiredskills;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Projects
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set activityarea
     *
     * @param string $activityarea
     *
     * @return Projects
     */
    public function setActivityarea($activityarea)
    {
        $this->activityarea = $activityarea;

        return $this;
    }

    /**
     * Get activityarea
     *
     * @return string
     */
    public function getActivityarea()
    {
        return $this->activityarea;
    }

    /**
     * Set projectdescription
     *
     * @param string $projectdescription
     *
     * @return Projects
     */
    public function setProjectdescription($projectdescription)
    {
        $this->projectdescription = $projectdescription;

        return $this;
    }

    /**
     * Get projectdescription
     *
     * @return string
     */
    public function getProjectdescription()
    {
        return $this->projectdescription;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Projects
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return Projects
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set payment
     *
     * @param string $payment
     *
     * @return Projects
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set experiencelevel
     *
     * @param string $experiencelevel
     *
     * @return Projects
     */
    public function setExperiencelevel($experiencelevel)
    {
        $this->experiencelevel = $experiencelevel;

        return $this;
    }

    /**
     * Get experiencelevel
     *
     * @return string
     */
    public function getExperiencelevel()
    {
        return $this->experiencelevel;
    }

    /**
     * Set requiredskills
     *
     * @param string $requiredskills
     *
     * @return Projects
     */
    public function setRequiredskills($requiredskills)
    {
        $this->requiredskills = $requiredskills;

        return $this;
    }

    /**
     * Get requiredskills
     *
     * @return string
     */
    public function getRequiredskills()
    {
        return $this->requiredskills;
    }
}

