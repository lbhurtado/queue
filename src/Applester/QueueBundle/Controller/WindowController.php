<?php

namespace Applester\QueueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Applester\QueueBundle\Entity\Window;
use Applester\QueueBundle\Form\WindowType;

/**
 * Window controller.
 *
 */
class WindowController extends Controller
{

    /**
     * Lists all Window entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplesterQueueBundle:Window')->findAll();

        return $this->render('ApplesterQueueBundle:Window:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Window entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Window();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('window_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplesterQueueBundle:Window:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Window entity.
    *
    * @param Window $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Window $entity)
    {
        $form = $this->createForm(new WindowType(), $entity, array(
            'action' => $this->generateUrl('window_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Window entity.
     *
     */
    public function newAction()
    {
        $entity = new Window();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplesterQueueBundle:Window:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Window entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Window')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Window entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Window:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Window entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Window')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Window entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Window:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Window entity.
    *
    * @param Window $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Window $entity)
    {
        $form = $this->createForm(new WindowType(), $entity, array(
            'action' => $this->generateUrl('window_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Window entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Window')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Window entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('window_edit', array('id' => $id)));
        }

        return $this->render('ApplesterQueueBundle:Window:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Window entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplesterQueueBundle:Window')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Window entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('window'));
    }

    /**
     * Creates a form to delete a Window entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('window_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
