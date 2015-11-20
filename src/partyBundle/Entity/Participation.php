<?php

namespace partyBundle\Entity;

/**
 * participation
 */
class Participation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    private $user;


    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User  $user
     *
     * @return Participation
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \partyBundle\Entity\Party
     */
    private $party;


    /**
     * Set party
     *
     * @param \partyBundle\Entity\Party $party
     *
     * @return Participation
     */
    public function setParty(\partyBundle\Entity\Party $party = null)
    {
        $this->party = $party;

        return $this;
    }

    /**
     * Get party
     *
     * @return \partyBundle\Entity\Party
     */
    public function getParty()
    {
        return $this->party;
    }
}
