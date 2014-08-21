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
     * @ORM\Column(name="textoes", type="text")
     * 
     * @Assert\NotNull(
     *      message = "validaciones.texto.not_null"
     * )
     */
    private $textoes;

    /**
     * @var string
     *
     * @ORM\Column(name="textoen", type="text")
     * 
     */
    private $textoen;

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
     * Set textoes
     *
     * @param string $textoes
     * @return Contenido
     */
    public function setTextoes($textoes) {
        $this->textoes = $textoes;

        return $this;
    }

    /**
     * Get textoes
     *
     * @return string 
     */
    public function getTextoes() {
        return $this->textoes;
    }

    /**
     * Set textoen
     *
     * @param string $textoen
     * @return Contenido
     */
    public function setTextoen($textoen) {
        $this->textoen = $textoen;

        return $this;
    }

    /**
     * Get textoen
     *
     * @return string 
     */
    public function getTextoen() {
        return $this->textoen;
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
