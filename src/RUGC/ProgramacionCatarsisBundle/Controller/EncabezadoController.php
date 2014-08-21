<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Encabezado;
use RUGC\ProgramacionCatarsisBundle\Form\EncabezadoType;

/**
 * Encabezado controller.
 *
 */
class EncabezadoController extends Controller {

    /**
     * Displays a form to edit an existing Encabezado entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encabezado entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Encabezado entity.
     *
     * @param Encabezado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Encabezado $entity) {
        $form = $this->createForm(new EncabezadoType(), $entity);

        $form->add('submit', 'submit', array('label' => 'form.submit_guardar_contenido', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDer')));

        return $form;
    }

    /**
     * Edits an existing Encabezado entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encabezado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('programacion'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
