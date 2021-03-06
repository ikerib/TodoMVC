<?php

namespace Ikerib\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="Tag")
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="tag", type="string", length=45, nullable=false)
     */
    private $tag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Todo", inversedBy="tag")
     * @ORM\JoinTable(name="tag_has_todo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Tag_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Todo_id", referencedColumnName="id")
     *   }
     * )
     */
    private $todo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->todo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTag();
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
     * Set tag
     *
     * @param string $tag
     * @return Tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add todo
     *
     * @param \Ikerib\BackendBundle\Entity\Todo $todo
     * @return Tag
     */
    public function addTodo(\Ikerib\BackendBundle\Entity\Todo $todo)
    {
        $this->todo[] = $todo;

        return $this;
    }

    /**
     * Remove todo
     *
     * @param \Ikerib\BackendBundle\Entity\Todo $todo
     */
    public function removeTodo(\Ikerib\BackendBundle\Entity\Todo $todo)
    {
        $this->todo->removeElement($todo);
    }

    /**
     * Get todo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTodo()
    {
        return $this->todo;
    }
}