<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tests
 *
 * @ORM\Table(name="tests")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestsRepository")
 */
class Tests
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
     * @ORM\Column(name="testdate", type="date")
     */
    private $testdate;

    /**
     * @var string
     *
     * @ORM\Column(name="testdescription", type="string", length=255)
     */
    private $testdescription;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Freelancer",inversedBy="id")
     * @ORM\JoinColumn(name="freelancer",referencedColumnName="id",onDelete="CASCADE")
     */
    private $freelancer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Examen",inversedBy="id")
     * @ORM\JoinColumn(name="examen",referencedColumnName="id",onDelete="CASCADE")
     */
    private $examen;

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
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
    }


    /**
     * Set testdate
     *
     * @param \DateTime $testdate
     *
     * @return Tests
     */
    public function setTestdate($testdate)
    {
        $this->testdate = $testdate;

        return $this;
    }

    /**
     * Get testdate
     *
     * @return \DateTime
     */
    public function getTestdate()
    {
        return $this->testdate;
    }

    /**
     * Set testdescription
     *
     * @param string $testdescription
     *
     * @return Tests
     */
    public function setTestdescription($testdescription)
    {
        $this->testdescription = $testdescription;

        return $this;
    }

    /**
     * Get testdescription
     *
     * @return string
     */
    public function getTestdescription()
    {
        return $this->testdescription;
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


}

