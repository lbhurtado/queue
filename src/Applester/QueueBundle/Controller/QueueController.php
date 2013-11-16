<?php

namespace Applester\QueueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Applester\QueueBundle\Entity\Queue;
use Applester\QueueBundle\Form\QueueType;

/**
 * Queue controller.
 *
 */
class QueueController extends Controller
{

    /**
     * Lists all Queue entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplesterQueueBundle:Queue')->findAll();

        return $this->render('ApplesterQueueBundle:Queue:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Queue entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Queue();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('queue_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplesterQueueBundle:Queue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Queue entity.
    *
    * @param Queue $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Queue $entity)
    {
        $form = $this->createForm(new QueueType(), $entity, array(
            'action' => $this->generateUrl('queue_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Queue entity.
     *
     */
    public function newAction()
    {
        $entity = new Queue();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplesterQueueBundle:Queue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Queue entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Queue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Queue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Queue:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Queue entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Queue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Queue entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Queue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Queue entity.
    *
    * @param Queue $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Queue $entity)
    {
        $form = $this->createForm(new QueueType(), $entity, array(
            'action' => $this->generateUrl('queue_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Queue entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Queue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Queue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('queue_edit', array('id' => $id)));
        }

        return $this->render('ApplesterQueueBundle:Queue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Queue entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplesterQueueBundle:Queue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Queue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('queue'));
    }

    /**
     * Creates a form to delete a Queue entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('queue_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
