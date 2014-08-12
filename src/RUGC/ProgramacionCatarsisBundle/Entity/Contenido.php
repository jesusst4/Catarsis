<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contenido
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\ContenidoRepository")
 */
class Contenido {

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
     * @ORM\Column(name="texto", type="text")
     * 
     * @Assert\NotNull(
     *      message = "validaciones.texto.not_null"
     * )
     */
    private $texto;

    /**
     * @ORM\OneToOne(targetEntity="OpcionesMenu", inversedBy="contenido", cascade={"all"})
     * @ORM\JoinColumn(name="opcioMenu_id", referencedColumnName="id")
     * 
     * @Assert\Valid
     */
    private $opcionMenu;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Contenido
     */
    public function setTexto($texto) {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto() {
        return $this->texto;
    }

    /**
     * Set opcionMenu
     *
     * @param string $opcionMenu
     * @return Contenido
     */
    public function setOpcionMenu($opcionMenu) {
        $this->opcionMenu = $opcionMenu;

        return $this;
    }

    /**
     * Get opcionMenu
     *
     * @return string 
     */
    public function getOpcionMenu() {
        return $this->opcionMenu;
    }

}
