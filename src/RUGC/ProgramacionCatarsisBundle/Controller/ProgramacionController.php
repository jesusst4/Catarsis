<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Programacion;
use RUGC\ProgramacionCatarsisBundle\Form\ProgramacionType;
use RUGC\ProgramacionCatarsisBundle\Entity\Comentario;
use RUGC\ProgramacionCatarsisBundle\Form\ComentarioType;

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

//        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->findAll();
        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);
        setlocale(LC_TIME, "es_ES@euro", "es_ES", "esp");
        $date = strftime('%B-%Y');
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionActual();

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $listaProgramaciones,
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
        $t = $request->request->get("fecha");
        $fecha = split(" ", $request->request->get("fecha"));
        $fecha1 = $this->obtenerNumeroMes($fecha[0], $fecha[1]);
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecha1);
        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();
            $entity->upload();
//            $request = new Request();
//            $request->request->set('fecha', $t);
            $entity = new Programacion();
            $form = $this->createCreateForm($entity);
            return $this->redirect($this->generateUrl('programacion_new', array('fecha' => $t)));
        }

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'programaciones' => $listaProgramaciones,
                    'fecha' => $t
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

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'button')));

        return $form;
    }

    /**
     * Displays a form to create a new Programacion entity.
     *
     */
    public function newAction(Request $request) {

        $fechaGet = $request->query->get("fecha");


        $fechaPost = $request->request->get("fecha");
        $fechaGeneral = NULL;
        if ($fechaGet) {
            $fechaGeneral = $fechaGet;
            $fecha = split(" ", $fechaGet);
            $fecha1 = $this->obtenerNumeroMes($fecha[0], $fecha[1]);
        } elseif ($fechaPost) {
            $fechaGeneral = $fechaPost;
            $fecha = split(" ", $fechaPost);
            $fecha1 = $this->obtenerNumeroMes($fecha[0], $fecha[1]);
        }

        echo $fechaPost . "lo que trae fecha " . $fechaGet;


        $em = $this->getDoctrine()->getManager();
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecha1);
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'programaciones' => $listaProgramaciones,
                    'fecha' => $fechaGeneral
        ));
    }

    private function obtenerNumeroMes($pMes, $pAnio) {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fecha = "";

        foreach ($meses as $key => $value) {
            $mes = $key + 1;
            if ($value == $pMes) {
                $fecha = $pAnio . "-" . $mes . "-01";
                break;
            }
        }
        return $fecha;
    }

    private function createCreateComentarioForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'button')));

        return $form;
    }

    /**
     * Finds and displays a Programacion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Programacion();
        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        $comentario = new Comentario();
        $comentario->setProgramacion($entity);
        $form = $this->createCreateComentarioForm($comentario);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }
        $path = $entity->getAbsolutePath();
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'path' => $path,
                    'comentario' => $comentario,
                    'form' => $form->createView()
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

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'button')));

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
        $entity->removeUpload();

        return $this->redirect($this->generateUrl('programacion'));
    }

    /**
     * Deletes a Programacion entity.
     *
     */
    public function deleteImagenAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programacion entity.');
        }
        $entity->removeUpload();
        $entity->path = null;
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('programacion_edit', array('id' => $entity->getId())));
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
                        ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'button')))
                        ->getForm()
        ;
    }

    public function selectMonthAction() {
        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:create.html.twig');
    }

}
