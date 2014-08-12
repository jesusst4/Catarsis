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
     * @ORM\Column(name="texto", type="text")
     * 
     * @Assert\NotNull(
     *      message = "validaciones.texto.not_null"
     * )
     */
    private $texto;

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
     * Set texto
     *
     * @param string $texto
     * @return Encabezado
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }
}
