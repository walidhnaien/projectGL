<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testresults
 *
 * @ORM\Table(name="testresults")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestresultsRepository")
 */
class Testresults
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
     * @ORM\Column(name="testquestions", type="string", length=255)
     */
    private $testquestions;

    /**
     * @var string
     *
     * @ORM\Column(name="testpro1", type="string", length=255)
     */
    private $testpro1;

    /**
     * @var string
     *
     * @ORM\Column(name="testpro2", type="string", length=255)
     */
    private $testpro2;

    /**
     * @var string
     *
     * @ORM\Column(name="testpro3", type="string", length=255)
     */
    private $testpro3;



    /**
     * @var string
     *
     * @ORM\Column(name="testanswer", type="string", length=255)
     */
    private $testanswer;


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
     * Set testquestions
     *
     * @param string $testquestions
     *
     * @return Testresults
     */
    public function setTestquestions($testquestions)
    {
        $this->testquestions = $testquestions;

        return $this;
    }

    /**
     * Get testquestions
     *
     * @return string
     */
    public function getTestquestions()
    {
        return $this->testquestions;
    }

    /**
     * Set testpro1
     *
     * @param string $testpro1
     *
     * @return Testresults
     */
    public function setTestpro1($testpro1)
    {
        $this->testpro1 = $testpro1;

        return $this;
    }

    /**
     * Get testpro1
     *
     * @return string
     */
    public function getTestpro1()
    {
        return $this->testpro1;
    }

    /**
     * Set testpro2
     *
     * @param string $testpro2
     *
     * @return Testresults
     */
    public function setTestpro2($testpro2)
    {
        $this->testpro2 = $testpro2;

        return $this;
    }

    /**
     * Get testpro2
     *
     * @return string
     */
    public function getTestpro2()
    {
        return $this->testpro2;
    }

    /**
     * Set testpro3
     *
     * @param string $testpro3
     *
     * @return Testresults
     */
    public function setTestpro3($testpro3)
    {
        $this->testpro3 = $testpro3;

        return $this;
    }

    /**
     * Get testpro3
     *
     * @return string
     */
    public function getTestpro3()
    {
        return $this->testpro3;
    }

    /**
     * Set testpro4
     *
     * @param string $testpro4
     *
     * @return Testresults
     */
    public function setTestpro4($testpro4)
    {
        $this->testpro4 = $testpro4;

        return $this;
    }

    /**
     * Get testpro4
     *
     * @return string
     */
    public function getTestpro4()
    {
        return $this->testpro4;
    }

    /**
     * Set testanswer
     *
     * @param string $testanswer
     *
     * @return Testresults
     */
    public function setTestanswer($testanswer)
    {
        $this->testanswer = $testanswer;

        return $this;
    }

    /**
     * Get testanswer
     *
     * @return string
     */
    public function getTestanswer()
    {
        return $this->testanswer;
    }
}

