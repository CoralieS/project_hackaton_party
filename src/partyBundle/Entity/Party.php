<?php

namespace partyBundle\Entity;

/**
 * party
 */
class Party
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $lieu;

    /**
     * @var integer
     */
    private $nblimit;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return party
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return party
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return party
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set nblimit
     *
     * @param integer $nblimit
     *
     * @return party
     */
    public function setNblimit($nblimit)
    {
        $this->nblimit = $nblimit;

        return $this;
    }

    /**
     * Get nblimit
     *
     * @return integer
     */
    public function getNblimit()
    {
        return $this->nblimit;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Party;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Party = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add party
     *
     * @param \partyBundle\Entity\Party $party
     *
     * @return Party
     */
    public function addParty(\partyBundle\Entity\Party $party)
    {
        $this->Party[] = $party;

        return $this;
    }

    /**
     * Remove party
     *
     * @param \partyBundle\Entity\Party $party
     */
    public function removeParty(\partyBundle\Entity\Party $party)
    {
        $this->Party->removeElement($party);
    }

    /**
     * Get party
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParty()
    {
        return $this->Party;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $User;


    /**
     * Add user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Party
     */
    public function addUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->User[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     */
    public function removeUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->User->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->User;
    }
}
