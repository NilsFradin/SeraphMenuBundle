<?php

namespace Seraph\Bundle\MenuBundle\Twig;

use Seraph\Bundle\MenuBundle\Entity\Menu;
use Seraph\Bundle\MenuBundle\Entity\MenuItem;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class MenuExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_Function('seraph_get_menu', array($this, 'getMenu'), array('needs_environement' => true, 'is_safe' => array('html')))
        );
    }

    protected $registry;
    protected $twig;

    public function __construct(ManagerRegistry $registry, \Twig_Environment $twig)
    {
        $this->registry = $registry;
        $this->twig = $twig;
    }

    public function getMenu($slug, $templates = "@SeraphMenu/front/_menu.html.twig")
    {
        if ($slug != '' && $slug != null){
            $qb = $this->registry->getRepository(Menu::class)->createQueryBuilder('m')
                ->andWhere('m.slug = :slug')
                ->setParameter('slug', $slug)
                ->getQuery();
            $menu = $qb->execute();

            if ($menu != null){
                $menu = $menu[0];
                $qb = $this->registry->getRepository(MenuItem::class)->createQueryBuilder('mi')
                    ->andWhere('mi.menu = :menu')
                    ->andWhere('mi.parent IS NULL')
                    ->setParameter('menu', $menu)
                    ->getQuery();

                $menu = $qb->execute();
            }
            else{
                $menu = "";
            }
        }
        else{
            $menu = "";
        }
        return $this->twig->render($templates, array('menu' => $menu));
    }
}