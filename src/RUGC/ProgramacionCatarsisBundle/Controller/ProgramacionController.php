<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\Programacion;
use RUGC\ProgramacionCatarsisBundle\Form\ProgramacionType;
use RUGC\ProgramacionCatarsisBundle\Entity\Comentario;
use RUGC\ProgramacionCatarsisBundle\Form\ComentarioType;
use RUGC\ProgramacionCatarsisBundle\Services\FechasServices;

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

        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);

        $mes = strftime('%m');
        $objFecha = new FechasServices();
        $fecha = $objFecha->obtenerNombreMes($mes);

        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionActual();

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $listaProgramaciones,
                    'radio' => $encabezadoRadio,
                    'tv' => $encabezadoTV,
                    'fecha' => $fecha
        ));
    }

    /**
     * Creates a new Programacion entity.
     *
     */
    public function createAction(Request $request) {
        $t = $request->request->get("fecha");
        $fecha = split(" ", $request->request->get("fecha"));

        $objFecha = new FechasServices();
        $fecha1 = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
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

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btnDer')));

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
        $objFecha = new FechasServices();
        if ($fechaGet) {
            $fechaGeneral = $fechaGet;
            $fecha = split(" ", $fechaGet);
            $fecha1 = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
        } elseif ($fechaPost) {
            $fechaGeneral = $fechaPost;
            $fecha = split(" ", $fechaPost);
            $fecha1 = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
        } else {
            return $this->render('RUGCProgramacionCatarsisBundle:Programacion:create.html.twig', array(
                        'mensaje' => "Ingrese la fecha"
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecha1);
        $entity = new Programacion();

        $date = new \DateTime($fecha1);

        $entity->setFecha($date);
        $form = $this->createCreateForm($entity);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'programaciones' => $listaProgramaciones,
                    'fecha' => $fechaGeneral
        ));
    }

    private function createCreateComentarioForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btnDer')));

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
                    'emailError' => "",
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

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btnDer')));

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
                        ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btnDer')))
                        ->getForm()
        ;
    }

    public function selectMonthAction() {
        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:create.html.twig', array(
                    'mensaje' => ""
        ));
    }

    public function searchMonthAction(Request $request) {
        $fecha = split(" ", $request->request->get("fecha"));

        $objFecha = new FechasServices();
        $fecNumerica = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
        $numMes = split("-", $fecNumerica);
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecNumerica);

        $nomMes = $objFecha->obtenerNombreMes($numMes[1]);
        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $listaProgramaciones,
                    'radio' => $encabezadoRadio,
                    'tv' => $encabezadoTV,
                    'fecha' => $nomMes
        ));
    }

    public function searchAction(Request $request) {
        $mensaje = null;
        if ($request->request->get("btnBuscar")) {
            $em = $this->getDoctrine()->getManager();
            $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionXArtista_Titulo($request->request->get("txtTitulo"), $request->request->get("txtObra"));

            if (count($listaProgramaciones) > 0) {
                $mensaje = "";
            } else {
                $mensaje = "No se encontraron coincidencias";
            }
            return $this->render('RUGCProgramacionCatarsisBundle:Programacion:Buscar.html.twig', array(
                        'mensaje' => $mensaje,
                        'titulo' => $request->request->get("txtTitulo"),
                        'obra' => $request->request->get("txtObra"),
                        'programaciones' => $listaProgramaciones
            ));
        } else {
            return $this->render('RUGCProgramacionCatarsisBundle:Programacion:Buscar.html.twig', array(
                        'mensaje' => " ",
                        'titulo' => '',
                        'obra' => '',
                        'programaciones' => ""
            ));
        }
    }

    public function programacionSecuencialAction(Request $request) {
        $objFecha = new FechasServices();
        $fechaPost = $request->request->get("fecha");
        $fecha = split("-", $fechaPost);
        $fecha1 = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
        $primerDía = null;
        if ($request->request->get("btnAnterior")) {
            $primerDía = $objFecha->restarFecha($fecha1);
        } else {
            $primerDía = $objFecha->SumarFecha($fecha1);
        }
        $mes = split('-', $primerDía);
        $fechaNombre = $objFecha->obtenerNombreMes($mes[1]);
        $em = $this->getDoctrine()->getManager();

        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionMesSecuencial($primerDía);

        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $listaProgramaciones,
                    'radio' => $encabezadoRadio,
                    'tv' => $encabezadoTV,
                    'fecha' => $fechaNombre
        ));
    }

    public function programacionSelectAction(Request $request, $fecha) {
        $em = $this->getDoctrine()->getManager();
        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);

        $objFecha = new FechasServices();
        $fechaString = $objFecha->obtenerNombreMesSeleccionado($fecha);
        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecha);
        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
                    'entities' => $listaProgramaciones,
                    'radio' => $encabezadoRadio,
                    'tv' => $encabezadoTV,
                    'fecha' => $fechaString
        ));

//        $objFecha = new FechasServices();
//        $fechaPost = $request->request->get("fecha");
//        $fecha = split("-", $fechaPost);
//        $fecha1 = $objFecha->obtenerFechaEnNumeros($fecha[0], $fecha[1]);
//        $primerDía = null;
//        if ($request->request->get("btnAnterior")) {
//            $primerDía = $objFecha->restarFecha($fecha1);
//        } else {
//            $primerDía = $objFecha->SumarFecha($fecha1);
//        }
//        $mes = split('-', $primerDía);
//        $fechaNombre = $objFecha->obtenerNombreMes($mes[1]);
//
//        $encabezadoRadio = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(1);
//        $encabezadoTV = $em->getRepository('RUGCProgramacionCatarsisBundle:Encabezado')->find(2);
//        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionMesSecuencial($primerDía);
//
//        return $this->render('RUGCProgramacionCatarsisBundle:Programacion:index.html.twig', array(
//                    'entities' => $listaProgramaciones,
//                    'radio' => $encabezadoRadio,
//                    'tv' => $encabezadoTV,
//                    'fecha' => $fechaNombre
//        ));
    }

}
