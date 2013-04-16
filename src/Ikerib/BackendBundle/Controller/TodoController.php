<?php

namespace Ikerib\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ikerib\BackendBundle\Entity\Todo;
use Ikerib\BackendBundle\Form\TodoType;

/**
 * Todo controller.
 *
 */
class TodoController extends Controller
{
    /**
     * Lists all Todo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Todo')->findAll();
        $entity = new Todo();
        $form   = $this->createForm(new TodoType(), $entity);

        return $this->render('BackendBundle:Todo:index.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Todo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Todo();
        $form = $this->createForm(new TodoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // return $this->redirect($this->generateUrl('todo_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('todo'));
        }

        return $this->render('BackendBundle:Todo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Todo entity.
     *
     */
    public function newAction()
    {
        $entity = new Todo();
        $form   = $this->createForm(new TodoType(), $entity);

        return $this->render('BackendBundle:Todo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Todo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Todo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Todo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Todo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Todo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todo entity.');
        }

        $editForm = $this->createForm(new TodoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Todo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Todo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Todo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Todo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TodoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('todo_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Todo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Todo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendBundle:Todo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Todo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todo'));
    }

    /**
     * Creates a form to delete a Todo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
