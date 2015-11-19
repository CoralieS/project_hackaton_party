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
}
