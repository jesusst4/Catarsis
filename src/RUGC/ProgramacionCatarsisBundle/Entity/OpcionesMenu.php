<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use RUGC\ProgramacionCatarsisBundle\Entity\Contenido;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OpcionesMenu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenuRepository")
 * @UniqueEntity(fields={"prioridad"},
 *    message="Ya se asignó esta prioridad")
 * 
 */
class OpcionesMenu {

    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreOpcion", type="string", length=100)
     * 
     * @Assert\NotNull(
     *      message = "Debe ingresar el nombre de opción."
     * )
     */
    private $nombreOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255)
     * 
     * @Assert\NotNull(
     *      message = "Debe ingresar la ruta."
     * )
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="smallint")
     * 
     * @Assert\NotNull(
     *      message = "Debe ingresar la prioridad."
     * )
     */
    private $prioridad;

    /**
     * @ORM\OneToOne(targetEntity="Contenido", mappedBy="opcionMenu", cascade={"all"})
     */
    private $contenido;

    /**
     * @ORM\ManyToOne(targetEntity="OpcionesMenu",inversedBy="children")
     * @ORM\JoinColumn(name="principal_id", referencedColumnName="id")
     */
    private $menuPrincipal;

    /**
     * @ORM\OneToMany(targetEntity="OpcionesMenu", mappedBy="menuPrincipal")
     */
    private $children;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombreOpcion
     *
     * @param string $nombreOpcion
     * @return OpcionesMenu
     */
    public function setNombreOpcion($nombreOpcion) {
        $this->nombreOpcion = $nombreOpcion;

        return $this;
    }

    /**
     * Get nombreOpcion
     *
     * @return string 
     */
    public function getNombreOpcion() {
        return $this->nombreOpcion;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     * @return OpcionesMenu
     */
    public function setRuta($ruta) {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta() {
        return $this->ruta;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     * @return OpcionesMenu
     */
    public function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer 
     */
    public function getPrioridad() {
        return $this->prioridad;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return OpcionesMenu
     */
    public function setContenido($contenido) {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido() {
        return $this->contenido;
    }

    /**
     * Set subMenu
     *
     * @param string $subMenu
     * @return OpcionesMenu
     */
    public function setMenuPrincipal($subMenu) {
        $this->menuPrincipal = $subMenu;

        return $this;
    }

    /**
     * Get subMenu
     *
     * @return string 
     */
    public function getMenuPrincipal() {
        return $this->menuPrincipal;
    }

    public function __toString() {
        return $this->nombreOpcion;
    }

    public function getSubOpciones() {
        return $this->children;
    }

}