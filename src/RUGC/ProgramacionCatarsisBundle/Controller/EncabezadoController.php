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
class EncabezadoController extends Controller
{

    /**
     * Lists all Encabezado entities.
     *
     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->findAll();
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:index.html.twig', array(
//            'entities' => $entities,
//        ));
//    }
    /**
     * Creates a new Encabezado entity.
     *
     */
//    public function createAction(Request $request)
//    {
//        $entity = new Encabezado();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('encabezado_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }

    /**
     * Creates a form to create a Encabezado entity.
     *
     * @param Encabezado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createCreateForm(Encabezado $entity)
//    {
//        $form = $this->createForm(new EncabezadoType(), $entity, array(
//            'action' => $this->generateUrl('encabezado_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }

    /**
     * Displays a form to create a new Encabezado entity.
     *
     */
//    public function newAction()
//    {
//        $entity = new Encabezado();
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }

    /**
     * Finds and displays a Encabezado entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Encabezado entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing Encabezado entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encabezado entity.');
        }

        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Encabezado entity.
    *
    * @param Encabezado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Encabezado $entity)
    {
        $form = $this->createForm(new EncabezadoType(), $entity, array(
            'action' => $this->generateUrl('encabezado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'form.submit_guardar_contenido','translation_domain' => 'RUGCProgramacionCatarsisBundle', 'attr'=>array('class'=>'btnDer')));

        return $form;
    }
    /**
     * Edits an existing Encabezado entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encabezado entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('programacion', array('id' => $id)));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Encabezado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Encabezado entity.
     *
     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Encabezado entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('encabezado'));
//    }

    /**
     * Creates a form to delete a Encabezado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('encabezado_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
//            ->getForm()
//        ;
//    }
}
