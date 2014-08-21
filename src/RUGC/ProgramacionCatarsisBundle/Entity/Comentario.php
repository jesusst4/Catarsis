<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comentario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\ComentarioRepository")
 */
class Comentario {

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
     * @ORM\Column(name="correo", type="string", length=50)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.correo.not_null"
     * )
     * 
     * @Assert\Email(
     *     message = "validaciones.correo.invalid",
     *     checkMX = true
     * )
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.nombre.not_null"
     * )     
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.comentario.not_null"
     * )     
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="smallint")
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var type 
     * @ORM\ManyToOne(targetEntity="Programacion", inversedBy="comentarios")
     * @ORM\JoinColumn(name="programacion_id", referencedColumnName="id" )
     * 
     */
    private $programacion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Comentario
     */
    public function setCorreo($correo) {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo() {
        return $this->correo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Comentario
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Comentario
     */
    public function setEstado($estado) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentario
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set programacion
     *
     * @param string programacion
     * @return Comentario
     */
    public function setProgramacion($programacion) {
        $this->programacion = $programacion;

        return $this;
    }

    /**
     * Get programacion
     *
     * @return string 
     */
    public function getProgramacion() {
        return $this->programacion;
    }

}
