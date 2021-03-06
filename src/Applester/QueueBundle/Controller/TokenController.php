<?php

namespace Applester\QueueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Applester\QueueBundle\Entity\Token;
use Applester\QueueBundle\Form\TokenType;

/**
 * Token controller.
 *
 */
class TokenController extends Controller
{

    /**
     * Lists all Token entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplesterQueueBundle:Token')->findAll();

        return $this->render('ApplesterQueueBundle:Token:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Token entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Token();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('token_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplesterQueueBundle:Token:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Token entity.
    *
    * @param Token $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Token $entity)
    {
        $form = $this->createForm(new TokenType(), $entity, array(
            'action' => $this->generateUrl('token_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Token entity.
     *
     */
    public function newAction()
    {
        $entity = new Token();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplesterQueueBundle:Token:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Token entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Token')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Token entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Token:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Token entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Token')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Token entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplesterQueueBundle:Token:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Token entity.
    *
    * @param Token $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Token $entity)
    {
        $form = $this->createForm(new TokenType(), $entity, array(
            'action' => $this->generateUrl('token_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Token entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplesterQueueBundle:Token')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Token entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('token_edit', array('id' => $id)));
        }

        return $this->render('ApplesterQueueBundle:Token:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Token entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplesterQueueBundle:Token')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Token entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('token'));
    }

    /**
     * Creates a form to delete a Token entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('token_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
