<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Programacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\ProgramacionRepository")
 * @UniqueEntity(fields={"fecha","tipo"},
 *   errorPath="tipo",
 *    message="validaciones.tipo.unique")
 */
class Programacion {

    public function __construct() {
        $this->comentarios = new ArrayCollection();
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     * 
     * @Assert\NotNull(
     *      message = "validaciones.fecha.not_null"
     * )
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.titulo.not_null"
     * )
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="obra", type="string", length=50, nullable=true)
     * 
     */
    private $obra;

    /**
     * @var string
     *
     * @ORM\Column(name="descripciones", type="string", length=255)
     * 
     * @Assert\NotNull(
     *      message = "validaciones.descripcion.not_null"
     * )
     */
    private $descripciones;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionen", type="string", length=255)
     * 
     */
    private $descripcionen;

    /**
     * @var string
     *
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="enlace", type="string", length=150, nullable=true)
     */
    private $enlace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    private $temp;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     * @Assert\NotNull(
     *      message = "validaciones.tipo.not_null"
     * )
     */
    private $tipo;

    /**
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="programacion", cascade={"all"})
     */
    private $comentarios;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Programacion
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
     * Set titulo
     *
     * @param string $titulo
     * @return Programacion
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
     * Set obra
     *
     * @param string $obra
     * @return Programacion
     */
    public function setObra($obra) {
        $this->obra = $obra;

        return $this;
    }

    /**
     * Get obra
     *
     * @return string 
     */
    public function getObra() {
        return $this->obra;
    }

    /**
     * Set descripciones
     *
     * @param string $descripciones
     * @return Programacion
     */
    public function setDescripciones($descripciones) {
        $this->descripciones = $descripciones;

        return $this;
    }

    /**
     * Get descripciones
     *
     * @return string 
     */
    public function getDescripciones() {
        return $this->descripciones;
    }

    /**
     * Set descripcionen
     *
     * @param string $descripcionen
     * @return Programacion
     */
    public function setDescripcionen($descripcionen) {
        $this->descripcionen = $descripcionen;

        return $this;
    }

    /**
     * Get descripcionen
     *
     * @return string 
     */
    public function getDescripcionen() {
        return $this->descripcionen;
    }

    /**
     * Set imagen
     *
     * @param  UploadedFile $imagen
     * @return Programacion
     */
    public function setImagen(UploadedFile $imagen = null) {
        $this->imagen = $imagen;


        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = $this->getImagen()->getClientOriginalName();
        } else {
            $this->path = $this->getImagen()->getClientOriginalName();
        }

        return $this;
    }

    /**
     * Get imagen
     *
     * @return UploadedFile 
     */
    public function getImagen() {
        return $this->imagen;
    }

    /**
     * Set enlace
     *
     * @param string $enlace
     * @return Programacion
     */
    public function setEnlace($enlace) {
        $this->enlace = $enlace;

        return $this;
    }

    /**
     * Get enlace
     *
     * @return string 
     */
    public function getEnlace() {
        return $this->enlace;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Programacion
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    
    public function getPath() {
        return $this->path;  
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getImagen()) {
            // haz lo que quieras para generar un nombre único
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getImagen()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getImagen()) {
            return;
        }

        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. This will properly prevent
        // the entity from being persisted to the database on error
        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->path = $this->getImagen()->getClientOriginalName();
        $this->getImagen()->move($this->getUploadRootDir(), $this->path);

        $this->imagen = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($imagen = $this->getAbsolutePath()) {
            unlink($imagen);
        }
    }

    
    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : 'uploads/documents' . '/' . $this->path;
    }

    protected function getUploadRootDir() {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__ . '/../../../../web/' . 'uploads/documents';
    }

}
