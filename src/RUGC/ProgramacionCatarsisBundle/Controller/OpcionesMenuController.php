<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenu;

/**
 * OpcionesMenu controller.
 *
 */
class OpcionesMenuController extends Controller {

    /**
     * Lists all OpcionesMenu entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('RUGCProgramacionCatarsisBundle:OpcionesMenu')->consultarMenuPrincipal();

        $idioma = $this->get('session')->get('_locale');

        if ($idioma === 'es') {
            return $this->render('RUGCProgramacionCatarsisBundle:Default:index.html.twig', array(
                        'entities' => $entities,
            ));
        } else {
            return $this->render('RUGCProgramacionCatarsisBundle:Default:indexEn.html.twig', array(
                        'entities' => $entities,
            ));
        }
    }

}
