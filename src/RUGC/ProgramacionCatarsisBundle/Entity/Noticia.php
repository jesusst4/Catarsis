<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Noticia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\NoticiaRepository")
 */
class Noticia {

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
     * @ORM\Column(name="titulo", type="string", length=255)
     * 
     * @Assert\NotNull(
     *      message = "Debe ingresar el título."
     * )
     */
    private $titulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text")
     * 
     *  @Assert\NotNull(
     *      message = "Debe ingresar el contenido."
     * )
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=50, nullable=true)
     */
    private $autor;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="smallint")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="string", length=255)
     * 
     *  @Assert\NotNull(
     *      message = "Debe ingresar el resumen."
     * )
     */
    private $resumen;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Noticia
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Noticia
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
     * Set contenido
     *
     * @param string $contenido
     * @return Noticia
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
     * Set autor
     *
     * @param string $autor
     * @return Noticia
     */
    public function setAutor($autor) {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor() {
        return $this->autor;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Noticia
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
     * Set resumen
     *
     * @param string $resumen
     * @return Noticia
     */
    public function setResumen($resumen) {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen() {
        return $this->resumen;
    }

}
