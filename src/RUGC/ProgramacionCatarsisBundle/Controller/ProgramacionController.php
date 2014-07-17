<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Programacion;
use RUGC\ProgramacionCatarsisBundle\Form\ProgramacionType;

/**
 * Programacion controller.
 *
 */
class ProgramacionController extends Controller {

    /**
     * Lists all Programacion entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->findAll();
        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);
        setlocale(LC_TIME, "es_ES@euro", "es_ES", "esp");
        $date = strftime('%B-%Y');

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $entities,
                    'radio' => $encabezadoRadio,
                    'tv' => $encabezadoTV,
                    'fecha' => $date
        ));
    }

    /**
     * Creates a new Programacion entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes();
        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();
            $entity->upload();
            return $this->redirect($this->generateUrl('programacion_show', array('id' => $entity->getId())));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'programaciones' => $listaProgramaciones
        ));
    }

    /**
     * Creates a form to create a Programacion entity.
     *
     * @param Programacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Programacion $entity) {
        $form = $this->createForm(new ProgramacionType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Crear','attr'=>array('class'=>'btn')));

        return $form;
    }

    /**
     * Displays a form to create a new Programacion entity.
     *
     */
    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes();
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'programaciones' => $listaProgramaciones
        ));
    }

    /**
     * Finds and displays a Programacion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Programacion();
        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }
        $path = $entity->getAbsolutePath();
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'path' => $path
        ));
    }

    /**
     * Displays a form to edit an existing Programacion entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Programacion entity.
     *
     * @param Programacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Programacion $entity) {
        $form = $this->createForm(new ProgramacionType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Actualizar','attr'=>array('class'=>'btn')));

        return $form;
    }

    /**
     * Edits an existing Programacion entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $entity->upload();

            return $this->redirect($this->generateUrl('programacion'));
        }
        
        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Programacion entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('programacion_new'));
    }

    /**
     * Creates a form to delete a Programacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('programacion_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Eliminar','attr'=>array('class'=>'btn')))
                        ->getForm()
        ;
    }

}
