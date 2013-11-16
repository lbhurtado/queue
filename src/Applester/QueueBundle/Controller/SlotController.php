<?php

namespace Applester\QueueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Applester\QueueBundle\Entity\Slot;
use Applester\QueueBundle\Form\SlotType;

/**
 * Slot controller.
 *
 */
class SlotController extends Controller
{

    /**
     * Lists all Slot entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplesterQueueBundle:Slot')->findAll();

        return $this->render('ApplesterQueueBundle:Slot:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Slot entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Slot();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('applester_slot_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplesterQueueBundle:Slot:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Slot entity.
    *
    * @param Slot $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Slot $entity)
    {
        $form = $this->createForm(new SlotType(), $entity, array(
            'action' => $this->generateUrl('applester_slot_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Slot entity.
     *
     */
    public function newAction()
    {
        $entity = new Slot();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplesterQueueBundle:Slot:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Slot entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Slot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slot entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Slot:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Slot entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Slot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slot entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Slot:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Slot entity.
    *
    * @param Slot $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Slot $entity)
    {
        $form = $this->createForm(new SlotType(), $entity, array(
            'action' => $this->generateUrl('applester_slot_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Slot entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Slot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slot entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('applester_slot_edit', array('id' => $id)));
        }

        return $this->render('ApplesterQueueBundle:Slot:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Slot entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplesterQueueBundle:Slot')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Slot entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('applester_slot'));
    }

    /**
     * Creates a form to delete a Slot entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('applester_slot_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
