<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flevaluation
 *
 * @ORM\Table(name="flevaluation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlevaluationRepository")
 */
class Flevaluation
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
     * @var string
     *
     * @ORM\Column(name="jobowner", type="string", length=255)
     */
    private $jobowner;


    /**
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Freelancer",inversedBy="id")
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
     * @return Flevaluation
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
     * Set jobowner
     *
     * @param string $jobowner
     *
     * @return Flevaluation
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

    /**
     * Set freelancer
     *
     * @param string $freelancer
     *
     * @return Flevaluation
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
}

