<?php

namespace Seraph\Bundle\MenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class MenuItem
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active = true;

    /**
     * @ORM\Column(name="target", type="string", length=255, nullable=true)
     */
    protected $target = '_self';

    /**
     * @ORM\Column(name="position", type="integer", nullable=false)
     * @Gedmo\SortablePosition()
     */
    protected $position;

    /**
     * @ORM\Column(name="depht", type="integer", nullable=false)
     */
    protected $depht = 1;

    /**
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="childrens")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent", cascade={"persist"})
     * @ORM\OrderBy({ "position" = "ASC" })
     */
    protected $childrens;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="items")
     */
    protected $menu;

    public function __construct()
    {
        $this->childrens = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return MenuItem
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return MenuItem
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return MenuItem
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     * @return MenuItem
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return MenuItem
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepht()
    {
        return $this->depht;
    }

    /**
     * @param mixed $depht
     * @return MenuItem
     */
    public function setDepht($depht)
    {
        $this->depht = $depht;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     * @return MenuItem
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildrens()
    {
        return $this->childrens;
    }

    /**
     * @param mixed $childrens
     * @return MenuItem
     */
    public function setChildrens($childrens)
    {
        $this->childrens = $childrens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     * @return MenuItem
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }

    public function removeChildren(MenuItem $children)
    {
        $this->childrens->removeElement($children);
        $children->setParent(null);
    }

    public function addChildrend(MenuItem $children)
    {
        $children->setParent($this);
        $this->childrens->add($children);
    }


}