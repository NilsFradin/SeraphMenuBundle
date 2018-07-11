<?php
/**
 * Created by PhpStorm.
 * User: sERAPH1
 * Date: 10/07/2018
 * Time: 11:40
 */

namespace id4v\Bundle\MenuBundle\Twig;

use Id4v\Bundle\MenuBundle\Entity\Menu;
use Id4v\Bundle\MenuBundle\Entity\MenuItem;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class MenuExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_Function('get_menu', array($this, 'getMenu'), array('needs_environement' => true, 'is_safe' => array('html')))
        );
    }

    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function getMenu(\Twig_Environment $twig, $slug, $templates = "Resources/views/front/_menu.html.twig" )
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
        return $twig->render($templates, array('menu' => $menu));
    }
}