<?php

namespace Seraph\Bundle\MenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="menu", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     * @ORM\OrderBy({ "depth" = "ASC", "position" = "ASC" })
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    { return $this->id; }

    /**
     * @param mixed $id
     * @return Menu
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    { return $this->name; }

    /**
     * @param mixed $name
     * @return Menu
     */
    public function setName($name)
    {
        $this->title = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    { return $this->slug; }

    /**
     * @param mixed $slug
     * @return Menu
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    { return $this->items; }

    /**
     * @param mixed $items
     * @return Menu
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    public function removeItem(MenuItem $item)
    {
        $this->items->removeElement($item);
        $item->setMenu(null);
    }

    public function addItem(MenuItem $item)
    {
        $item->setMenu($this);
        $this->items->add($item);

        return $this;
    }

    public function __toString()
    {
        return $this->getName().'';
    }
}