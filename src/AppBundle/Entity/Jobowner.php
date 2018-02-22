<?php

namespace AppBundle\Entity;
use AppBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Jobowner
 *
 * @ORM\Table(name="jobowner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobownerRepository")
 */
class Jobowner
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="activitySector", type="string", length=255)
     */
    private $activitySector;

    /**
     * @var string
     *
     * @ORM\Column(name="socialRaison", type="string", length=255)
     */
    private $socialRaison;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="user",referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;


    /**
     * One Jobowner has Many Projects.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Projects", mappedBy="jobowner")
     */
    private $projects;

    /**
     * One Jobowner has Many Joevaluation.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Joevaluation", mappedBy="jobowner")
     */
    private $joevaluation;


    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;


    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="integer")
     */
    private $mobile;

    /**
     * @var string
     */
    protected $email;
    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    protected $plainPassword;
    /**
     * @var string
     */
    protected $username;


    public function __construct() {
        $this->projects = new ArrayCollection();
        $this->joevaluation = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
    public function getUser()
    {

        return $this->user;
    }

    public function setProject($project)
    {
        $this->projects = $project;
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function setJoevaluation($joevaluation)
    {
        $this->joevaluation = $joevaluation;
    }

    public function getJoevaluation()
    {
        return $this->joevaluation;
    }

    /**
     * Set activitySector
     *
     * @param string $activitySector
     *
     * @return Jobowner
     */
    public function setActivitySector($activitySector)
    {
        $this->activitySector = $activitySector;

        return $this;
    }

    /**
     * Get activitySector
     *
     * @return string
     */
    public function getActivitySector()
    {
        return $this->activitySector;
    }

    /**
     * Set socialRaison
     *
     * @param string $socialRaison
     *
     * @return Jobowner
     */
    public function setSocialRaison($socialRaison)
    {
        $this->socialRaison = $socialRaison;

        return $this;
    }

    /**
     * Get socialRaison
     *
     * @return string
     */
    public function getSocialRaison()
    {
        return $this->socialRaison;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }































}

