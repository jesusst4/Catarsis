<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Encabezado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RUGC\ProgramacionCatarsisBundle\Entity\EncabezadoRepository")
 */
class Encabezado
{
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
     * @Assert\NotNull(
     *      message = "validaciones.texto.not_null"
     * )
     */
    private $textoen;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set textoes
     *
     * @param string $textoes
     * @return Encabezado
     */
    public function setTextoes($textoes)
    {
        $this->textoes = $textoes;

        return $this;
    }

    /**
     * Get textoes
     *
     * @return string 
     */
    public function getTextoes()
    {
        return $this->textoes;
    }
    
    /**
     * Set textoen
     *
     * @param string $textoen
     * @return Encabezado
     */
    public function setTextoen($textoen)
    {
        $this->textoen = $textoen;

        return $this;
    }

    /**
     * Get textoen
     *
     * @return string 
     */
    public function getTextoen()
    {
        return $this->textoen;
    }
}
