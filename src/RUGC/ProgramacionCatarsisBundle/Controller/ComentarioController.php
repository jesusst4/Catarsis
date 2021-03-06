<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Comentario;
use RUGC\ProgramacionCatarsisBundle\Form\ComentarioType;
use RUGC\ProgramacionCatarsisBundle\Services\ValidarEmail;

/**
 * Comentario controller.
 *
 */
class ComentarioController extends Controller {

    /**
     * Lists all Comentario entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Comentario')->findBy(array('estado' => '0'), array('fecha' => 'DESC'));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $entities, $this->get('request')->query->get('page', 1), 10
        );

        return $this->render('RUGCProgramacionCatarsisBundle:Comentario:index.html.twig', array(
                    'entities' => $pagination,
        ));
    }

    /**
     * Creates a new Comentario entity.
     *
     */
    public function createAction(Request $request) {
        $comentario = new Comentario();
        $form = $this->createCreateComentarioForm($comentario);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $idProgramacion = $request->request->get("idProgramacion");
        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($idProgramacion);

        if ($form->isValid()) {
            $comentario->setProgramacion($entity);
            $comentario->setFecha(new \DateTime("now"));
            $comentario->setEstado(0);

            $validar = new ValidarEmail($comentario->getCorreo());
            if ($validar->validate() == 0) {
                return $this->render('RUGCProgramacionCatarsisBundle:Programacion:show.html.twig', array(
                            'entity' => $entity,
                            'emailError' => "Correo electrónico inválido",
                            'comentario' => $comentario,
                            'form' => $form->createView(),
                            'listaComentarios' => ""
                ));
            }

            $em->persist($comentario);
            $em->flush();
            $this->get('enviarNotificacionServices')->notificarNuevoComentario();

            return $this->redirect($this->generateUrl('programacion'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:show.html.twig', array(
                    'entity' => $entity,
                    'emailError' => "",
                    'comentario' => $comentario,
                    'form' => $form->createView(),
                    'listaComentarios' => ""
        ));
    }

    /**
     * Creates a form to create a Comentario entity.
     *
     * @param Comentario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateComentarioForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity);

        $form->add('submit', 'submit', array('label' => 'form.submit_crear', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDer')));

        return $form;
    }

    /**
     * Finds and displays a Comentario entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Comentario:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Comentario entity.
     *
     * @param Comentario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity, array(
            'action' => $this->generateUrl('comentario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Comentario entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }

        if ($request->request->get("btnPublicar")) {
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            $entity->setEstado(1);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario'));
        } elseif ($request->request->get("btnRechazar")) {

            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            $entity->setEstado(2);
            $entity->setComentario("Comentario eliminado debido a su contenido");
            $em->flush();

            $this->get('enviarNotificacionServices')->notificarComentarioEliminado($entity);
            return $this->redirect($this->generateUrl('comentario'));
        }
    }

    /**
     * Deletes a Comentario entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Comentario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comentario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comentario'));
    }

    /**
     * Creates a form to delete a Comentario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('comentario_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.submit_eliminar', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnIzq')))
                        ->getForm()
        ;
    }

}
