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
 * @UniqueEntity(fields={"prioridad", "menuPrincipal"},
 *    message="validaciones.prioridad.unique")
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
     * @ORM\Column(name="nombreOpcion_es", type="string", length=100)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.nombre_opcion.not_null"
     * )
     */
    private $nombreOpcionEs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombreOpcion_en", type="string", length=100)
     * 
     */
    private $nombreOpcionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255)
     * 

     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="smallint")
     * 
     * @Assert\NotNull(
     *      message = "validaciones.prioridad.not_null"
     * )
     * 
     * @Assert\Range(
     *      min = "1",
     *      minMessage = "validaciones.prioridad.minimo",
     *      invalidMessage = "validaciones.prioridad.numeric"
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
     *      
     */
    private $menuPrincipal;

    /**
     * @ORM\OneToMany(targetEntity="OpcionesMenu", mappedBy="menuPrincipal")
     */
    private $children;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="permiso", type="smallint")
     * 
     */
    private $permiso;
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombreOpcionEs
     *
     * @param string $nombreOpcionEs
     * @return OpcionesMenu
     */
    public function setNombreOpcionEs($nombreOpcionEs) {
        $this->nombreOpcionEs = $nombreOpcionEs;

        return $this;
    }

    /**
     * Get nombreOpcionEs
     *
     * @return string 
     */
    public function getNombreOpcionEs() {
        return $this->nombreOpcionEs;
    }
    
     /**
     * Set nombreOpcionEn
     *
     * @param string $nombreOpcionEn
     * @return OpcionesMenu
     */
    public function setNombreOpcionEn($nombreOpcionEn) {
        $this->nombreOpcionEn = $nombreOpcionEn;

        return $this;
    }

    /**
     * Get nombreOpcionEn
     *
     * @return string 
     */
    public function getNombreOpcionEn() {
        return $this->nombreOpcionEn;
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
        return $this->nombreOpcionEs.' - '.  $this->nombreOpcionEn;
    }

    public function setChildren($subMenu) {
        $this->children[] = $subMenu;
    }

    /**
     * Get subMenu
     *
     * @return array 
     */
    public function getChildren() {
        return $this->children;
    }
    
    
    /**
     * Set permiso
     *
     * @param integer $permiso
     * @return OpcionesMenu
     */
    public function setPermiso($permiso) {
        $this->permiso = $permiso;

        return $this;
    }

    /**
     * Get permiso
     *
     * @return integer 
     */
    public function getPermiso() {
        return $this->permiso;
    }
    
//    public function toString() {
//        return $this->nombreOpcion_es;
//    }

}
