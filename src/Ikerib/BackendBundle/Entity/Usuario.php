<?php

namespace Ikerib\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="Usuario")
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Todo
     *
     * @ORM\ManyToOne(targetEntity="Todo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Todo_id", referencedColumnName="id")
     * })
     */
    private $todo;

    public function __toString()
    {
        return $this->getTodo();
    }

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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set todo
     *
     * @param \Ikerib\BackendBundle\Entity\Todo $todo
     * @return Usuario
     */
    public function setTodo(\Ikerib\BackendBundle\Entity\Todo $todo = null)
    {
        $this->todo = $todo;

        return $this;
    }

    /**
     * Get todo
     *
     * @return \Ikerib\BackendBundle\Entity\Todo
     */
    public function getTodo()
    {
        return $this->todo;
    }
}