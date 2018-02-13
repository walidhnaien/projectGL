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
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=255)
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="receiver", type="string", length=255)
     */
    private $receiver;


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
     * Set demandDate
     *
     * @param \DateTime $demandDate
     *
     * @return Demands
     */
    public function setDemandDate($demandDate)
    {
        $this->demandDate = $demandDate;

        return $this;
    }

    /**
     * Get demandDate
     *
     * @return \DateTime
     */
    public function getDemandDate()
    {
        return $this->demandDate;
    }

    /**
     * Set demandstatus
     *
     * @param string $demandstatus
     *
     * @return Demands
     */
    public function setDemandstatus($demandstatus)
    {
        $this->demandstatus = $demandstatus;

        return $this;
    }

    /**
     * Get demandstatus
     *
     * @return string
     */
    public function getDemandstatus()
    {
        return $this->demandstatus;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return Demands
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     *
     * @return Demands
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}

