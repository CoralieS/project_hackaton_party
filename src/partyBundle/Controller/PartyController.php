<?php

namespace partyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use partyBundle\Entity\Party;

/**
 * Party controller.
 *
 */
class PartyController extends Controller
{

    /**
     * Lists all Party entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('partyBundle:Party')->findAll();

        return $this->render('partyBundle:Party:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Party entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Party')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Party entity.');
        }

        return $this->render('partyBundle:Party:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
