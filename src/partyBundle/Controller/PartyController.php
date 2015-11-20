<?php

namespace partyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use partyBundle\Entity\Party;
use partyBundle\Form\PartyType;
use partyBundle\Entity\Participation;

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
     * Creates a new Party entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Party();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('party_show', array('id' => $entity->getId())));
        }

        return $this->render('partyBundle:Party:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Party entity.
     *
     * @param Party $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Party $entity)
    {
        $form = $this->createForm(new PartyType(), $entity, array(
            'action' => $this->generateUrl('party_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Party entity.
     *
     */
    public function newAction()
    {
        $entity = new Party();
        $form   = $this->createCreateForm($entity);

        return $this->render('partyBundle:Party:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Party entity.
     *
     */
    public function showAction(party $party_id)
    {

    }

    /**
     * Displays a form to edit an existing Party entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Party')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Party entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('partyBundle:Party:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Party entity.
    *
    * @param Party $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Party $entity)
    {
        $form = $this->createForm(new PartyType(), $entity, array(
            'action' => $this->generateUrl('party_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Party entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Party')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Party entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('party_edit', array('id' => $id)));
        }

        return $this->render('partyBundle:Party:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Party entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('partyBundle:Party')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Party entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('party'));
    }

    /**
     * Creates a form to delete a Party entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('party_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function inscriptionAction(Party $party_id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $utilisateur_soiree = $em->getRepository('partyBundle:Participation')->findOneBy(array('party' => $party_id, 'user' => $user));
        $party = $em->getRepository('partyBundle:Party')->findOneById($party_id);
        if ($utilisateur_soiree == null)
        {
            // Inscription
            $entity = new Participation();
            $entity->setUser($user);
            $entity->setParty($party_id);
            if ($party->getNblimit() > 0) {
                $party->setNblimit($party->getNblimit() - 1);
            }
            $party->setNbPersonne($party->getNbPersonne() + 1);

            $em->persist($entity);
            $em->persist($party);
            $em->flush();
        }
        else {
            // Desinscription
            if ($party->getNblimit() > 0) {
                $party->setNblimit($party->getNblimit() + 1);
            }
            if ($party->getNblimit() == 0) {
                $party->setNbPersonne($party->getNbPersonne());
            }
            else {
                $party->setNbPersonne($party->getNbPersonne() - 1);
            }
            $em->remove($utilisateur_soiree);
            $em->persist($party);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('party'));
    }
}
