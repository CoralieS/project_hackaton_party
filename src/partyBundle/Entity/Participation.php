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
     * @var boolean
     */
    private $paiement;

    /**
     * @var boolean
     */
    private $participation;


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
     * Set paiement
     *
     * @param boolean $paiement
     *
     * @return participation
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return boolean
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set participation
     *
     * @param boolean $participation
     *
     * @return participation
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return boolean
     */
    public function getParticipation()
    {
        return $this->participation;
    }
}
