<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RUGC\ProgramacionCatarsisBundle\Entity\Enlace;
use RUGC\ProgramacionCatarsisBundle\Form\EnlaceType;

/**
 * Enlace controller.
 *
 */
class EnlaceController extends Controller
{

    /**
     * Lists all Enlace entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Enlace')->findBy(array(), array('id' => 'DESC'));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $entities, $this->get('request')->query->get('page', 1), 10
        );
        
        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
    /**
     * Creates a new Enlace entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Enlace();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enlace'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Enlace entity.
     *
     * @param Enlace $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Enlace $entity)
    {
        $form = $this->createForm(new EnlaceType(), $entity, array(
            'action' => $this->generateUrl('enlace_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'form.submit_crear', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDer')));

        return $form;
    }

    /**
     * Displays a form to create a new Enlace entity.
     *
     */
    public function newAction()
    {
        $entity = new Enlace();
        $form   = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Enlace entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Enlace')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enlace entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Enlace entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Enlace')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enlace entity.');
        }

        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Enlace entity.
    *
    * @param Enlace $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Enlace $entity)
    {
        $form = $this->createForm(new EnlaceType(), $entity, array(
            'action' => $this->generateUrl('enlace_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'form.submit_guardar_contenido', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDerGuardar')));

        return $form;
    }
    /**
     * Edits an existing Enlace entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Enlace')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enlace entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('enlace'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Enlace:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Enlace entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
       
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Enlace')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Enlace entity.');
            }

            $em->remove($entity);
            $em->flush();
        

        return $this->redirect($this->generateUrl('enlace'));
    }

    /**
     * Creates a form to delete a Enlace entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enlace_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.submit_eliminar','translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr'=>array('class'=>'btnIzq')))
            ->getForm()
        ;
    }
}
