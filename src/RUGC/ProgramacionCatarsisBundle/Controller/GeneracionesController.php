<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RUGC\ProgramacionCatarsisBundle\Entity\Generaciones;
use RUGC\ProgramacionCatarsisBundle\Form\GeneracionesType;

/**
 * Generaciones controller.
 *
 */
class GeneracionesController extends Controller
{

    /**
     * Lists all Generaciones entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Generaciones')->findAll();

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Generaciones entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Generaciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('generaciones_show'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Generaciones entity.
    *
    * @param Generaciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Generaciones $entity)
    {
        $form = $this->createForm(new GeneracionesType(), $entity, array(
            'action' => $this->generateUrl('generaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Generaciones entity.
     *
     */
    public function newAction()
    {
        $entity = new Generaciones();
        $form   = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Generaciones entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Generaciones')->find(1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Generaciones entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:show.html.twig', array(
            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        
            ));
    }

    /**
     * Displays a form to edit an existing Generaciones entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Generaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Generaciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Generaciones entity.
    *
    * @param Generaciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Generaciones $entity)
    {
        $form = $this->createForm(new GeneracionesType(), $entity, array(
            'action' => $this->generateUrl('generaciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn')));

        return $form;
    }
    /**
     * Edits an existing Generaciones entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Generaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Generaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('generaciones_show'));
//            return $this->redirect($this->generateUrl('generaciones_edit', array('id' => $id)));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Generaciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Generaciones entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Generaciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Generaciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('generaciones'));
    }

    /**
     * Creates a form to delete a Generaciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generaciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
