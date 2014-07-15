<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RUGC\ProgramacionCatarsisBundle\Entity\Conozcanos;
use RUGC\ProgramacionCatarsisBundle\Form\ConozcanosType;

/**
 * Conozcanos controller.
 *
 */
class ConozcanosController extends Controller
{

    /**
     * Lists all Conozcanos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Conozcanos')->findAll();

        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Conozcanos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Conozcanos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conozcanos_show', array('id' => $entity->getId())));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Conozcanos entity.
     *
     * @param Conozcanos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Conozcanos $entity)
    {
        $form = $this->createForm(new ConozcanosType(), $entity, array(
            'action' => $this->generateUrl('conozcanos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Conozcanos entity.
     *
     */
    public function newAction()
    {
        $entity = new Conozcanos();
        $form   = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Conozcanos entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Conozcanos')->find(1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conozcanos entity.');
        }

        $deleteForm = $this->createDeleteForm(1);

        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Conozcanos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Conozcanos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conozcanos entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a Conozcanos entity.
    *
    * @param Conozcanos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Conozcanos $entity)
    {
        $form = $this->createForm(new ConozcanosType(), $entity, array(
            'action' => $this->generateUrl('conozcanos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn')));

        return $form;
    }
    /**
     * Edits an existing Conozcanos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Conozcanos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conozcanos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('conozcanos'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Conozcanos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Conozcanos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Conozcanos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conozcanos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conozcanos'));
    }

    /**
     * Creates a form to delete a Conozcanos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conozcanos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btn')))
            ->getForm();
    }
}
