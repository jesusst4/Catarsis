<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Contenido;
use RUGC\ProgramacionCatarsisBundle\Form\ContenidoType;
use RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenu;
//use RUGC\ProgramacionCatarsisBundle\Form\OpcionesMenuType;

/**
 * Contenido controller.
 *
 */
class ContenidoController extends Controller {

    /**
     * Lists all Contenido entities.
     *
     */
//    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->findAll();
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:index.html.twig', array(
//                    'entities' => $entities,
//        ));
//    }

    /**
     * Creates a new Contenido entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Contenido();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->getOpcionMenu()->setRuta('contenido_show');
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contenido_show', array('id' => $entity->getOpcionMenu()->getId())));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Contenido entity.
     *
     * @param Contenido $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contenido $entity) {
        $form = $this->createForm(new ContenidoType(), $entity);
        $form->add('submit', 'submit', array('label' => 'form.submit_guardar_contenido', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDer')));
        return $form;
    }

    /**
     * Displays a form to create a new Contenido entity.
     *
     */
    public function newAction() {
        $entity = new Contenido();
        $form = $this->createCreateForm($entity);
        $opcionMenu = new OpcionesMenu();
        $entity->setOpcionMenu($opcionMenu);
        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:new.html.twig', array(
                    'entity' => $entity,
                    'opcionMenu' => $opcionMenu,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contenido entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->findOneByOpcionMenu($id);

        if (!$entity) {
            return $this->render('RUGCProgramacionCatarsisBundle:Contenido:show.html.twig', array(
                        'entity' => $entity,
                        'mensaje' => 'No hay contenido disponible'
            ));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:show.html.twig', array(
                    'entity' => $entity,
                    'mensaje' => ''
        ));
    }

    /**
     * Displays a form to edit an existing Contenido entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contenido entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Contenido entity.
     *
     * @param Contenido $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Contenido $entity) {
        $form = $this->createForm(new ContenidoType(), $entity);

        $form->add('submit', 'submit', array('label' => 'form.submit_guardar_contenido', 'translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr' => array('class' => 'btnDer')));

        return $form;
    }

    /**
     * Edits an existing Contenido entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->findOneByOpcionMenu($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contenido entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('contenido_show', array('id' => $id)));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contenido entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contenido entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contenido'));
    }

    /**
     * Creates a form to delete a Contenido entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('contenido_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Finds and displays a Contenido entity.
     *
     */
    public function homeAction() {
        $em = $this->getDoctrine()->getManager();

        $idOpcion = $em->getRepository('RUGCProgramacionCatarsisBundle:OpcionesMenu')->consultarHome();

        $entity = null;
        if ($idOpcion) {
            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Contenido')->findOneByopcionMenu($idOpcion[0]['id']);
        }


        if (!$entity) {
            return $this->render('RUGCProgramacionCatarsisBundle:Contenido:show.html.twig', array(
                        'entity' => $entity,
                        'mensaje' => 'No hay contenido disponible'));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Contenido:show.html.twig', array(
                    'entity' => $entity,
                    'mensaje' => ''
        ));
    }

}
