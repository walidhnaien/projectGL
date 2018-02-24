<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Joevaluation
 *
 * @ORM\Table(name="joevaluation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JoevaluationRepository")
 */
class Joevaluation
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
     * @var int
     *
     * @ORM\Column(name="mark", type="integer")
     */
    private $mark;


    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Jobowner",inversedBy="id", cascade={"persist"})
    * @ORM\JoinColumn(name="jobowner",referencedColumnName="id",onDelete="CASCADE")
    */
    private $jobowner;


    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Freelancer",inversedBy="id", cascade={"persist"})
    * @ORM\JoinColumn(name="freelancer",referencedColumnName="id",onDelete="CASCADE")
    */
    private $freelancer;



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
     * Set mark
     *
     * @param integer $mark
     *
     * @return Joevaluation
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return int
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set freelancer
     *
     * @param string $freelancer
     *
     * @return Joevaluation
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return string
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * Set jobowner
     *
     * @param string $jobowner
     *
     * @return Joevaluation
     */
    public function setJobowner($jobowner)
    {
        $this->jobowner = $jobowner;

        return $this;
    }

    /**
     * Get jobowner
     *
     * @return string
     */
    public function getJobowner()
    {
        return $this->jobowner;
    }
}

