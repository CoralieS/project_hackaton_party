<?php

namespace partyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use partyBundle\Entity\Participation;
use partyBundle\Form\ParticipationType;

/**
 * Participation controller.
 *
 */
class ParticipationController extends Controller
{

    /**
     * Lists all Participation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('partyBundle:Participation')->findAll();

        return $this->render('partyBundle:Participation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Participation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Participation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('participation_show', array('id' => $entity->getId())));
        }

        return $this->render('partyBundle:Participation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Participation entity.
     *
     * @param Participation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Participation $entity)
    {
        $form = $this->createForm(new ParticipationType(), $entity, array(
            'action' => $this->generateUrl('participation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Participation entity.
     *
     */
    public function newAction()
    {
        $entity = new Participation();
        $form   = $this->createCreateForm($entity);

        return $this->render('partyBundle:Participation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Participation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Participation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('partyBundle:Participation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Participation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Participation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('partyBundle:Participation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Participation entity.
    *
    * @param Participation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Participation $entity)
    {
        $form = $this->createForm(new ParticipationType(), $entity, array(
            'action' => $this->generateUrl('participation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Participation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('partyBundle:Participation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Participation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('participation_edit', array('id' => $id)));
        }

        return $this->render('partyBundle:Participation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Participation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('partyBundle:Participation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Participation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('participation'));
    }

    /**
     * Creates a form to delete a Participation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
