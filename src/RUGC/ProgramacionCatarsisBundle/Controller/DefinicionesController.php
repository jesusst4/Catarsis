<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RUGC\ProgramacionCatarsisBundle\Entity\Definiciones;
use RUGC\ProgramacionCatarsisBundle\Form\DefinicionesType;

/**
 * Definiciones controller.
 *
 */
class DefinicionesController extends Controller
{

    /**
     * Lists all Definiciones entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Definiciones')->findAll();

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Definiciones entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Definiciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('definiciones_show'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Definiciones entity.
    *
    * @param Definiciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Definiciones $entity)
    {
        $form = $this->createForm(new DefinicionesType(), $entity, array(
            'action' => $this->generateUrl('definiciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Definiciones entity.
     *
     */
    public function newAction()
    {
        $entity = new Definiciones();
        $form   = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Definiciones entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Definiciones')->find(1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definiciones entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:show.html.twig', array(
            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        
            ));
    }

    /**
     * Displays a form to edit an existing Definiciones entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Definiciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definiciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Definiciones entity.
    *
    * @param Definiciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Definiciones $entity)
    {
        $form = $this->createForm(new DefinicionesType(), $entity, array(
            'action' => $this->generateUrl('definiciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Definiciones entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Definiciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Definiciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('definiciones_show'));
//            return $this->redirect($this->generateUrl('definiciones_edit', array('id' => $id)));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Definiciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Definiciones entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Definiciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Definiciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('definiciones'));
    }

    /**
     * Creates a form to delete a Definiciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('definiciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
