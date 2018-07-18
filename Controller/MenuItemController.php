<?php

namespace Seraph\Bundle\MenuBundle\Controller;

use Seraph\Bundle\MenuBundle\Entity\Menu;
use Seraph\Bundle\MenuBundle\Entity\MenuItem;
use Seraph\Bundle\MenuBundle\Form\Type\MenuItemType;
use Seraph\Bundle\MenuBundle\Manager\MenuManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemController extends Controller
{
    /**
     * @Route(name="seraph-list-menuItem", path="/menu/{id_menu}/menuItem/list")
     */
    public function listMenuItem(MenuManager $manager, $id_menu)
    {
        /** @var Menu $menu */
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id_menu);

        $menuItemQuery = $this->getDoctrine()->getRepository(MenuItem::class)->createQueryBuilder('m')
            ->andWhere('m.menu = :menu')
            ->andWhere('m.parent IS null')
            ->setParameter('menu', $menu)
            ->orderBy('m.position', 'ASC')
            ->getQuery();

        $menuItems = $menuItemQuery->execute();

        return $this->render('@SeraphMenu/back/menuItem/list.html.twig', array('forms' => $manager->generateForms($menuItems), 'menu' => $menu));
    }

    /**
     * @Route(name="seraph-editOrganize-menuItem", path="/menu/{id_menu}/editOrganize")
     */
    public function editMenuItemOrganize(Request $request, $id_menu)
    {
        if ($request->getMethod() == 'POST'){
            $repository = $this->getDoctrine()->getRepository(MenuItem::class);

            foreach ($request->request->all() as $param){
                $parent = $repository->find($param['parent']);
                /** @var MenuItem $item */
                $item = $repository->find($param['id']);
                $item->setdepth($param['depth'])
                    ->setPosition($param['position'])
                    ->setParent($parent);
                $this->getDoctrine()->getManager()->persist($item);
            }
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->redirectToRoute('seraph-list-menu', array('id_menu' => $id_menu));
    }

    /**
     * @Route(name="seraph-add-menuItem", path="/menu/{id_menu}/menuItem/add")
     */
    public function addMenuItem(Request $request, $id_menu)
    {
        $menu= $this->getDoctrine()->getRepository(Menu::class)->find($id_menu);

        $menuItem = new MenuItem();
        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $menuItem->setMenu($menu);

            if (count($menu->getItems()) == 0){
                $qb = $this->getDoctrine()->getRepository(MenuItem::class)->createQueryBuilder('m')
                    ->select('MAX(m.position) as maxpos')
                    ->andwWhere('m.menu = :menu')
                    ->andWhere('m.parent IS null')
                    ->setParameter('menu', $menu)
                    ->getQuery();

                $menuItem->setPosition($qb->getSingleScalarResult() + 1);
            }

            $this->getDoctrine()->getManager()->persist($menuItem);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seraph-list-menuItem', array('id_menu' => $id_menu));
        }
        return $this->render('@SeraphMenu/back/menuItem/modify.html.twig', array('form' => $form->createView(), 'menu' => $menu));
    }

    /**
     * @Route(name="seraph-edit-menuItem", path="/menu/{id_menu}/menuItem/edit/{id_menuItem}")
     */
    public function editMenuItem(Request $request, $id_menu, $id_menuItem)
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id_menu);
        $menuItem = $this->getDoctrine()->getRepository(MenuItem::class)->find($id_menuItem);

        $form = $this->createForm(MenuItem::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->persist($menuItem);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seraph-list-menuItem', array('id_menu' => $id_menu));
        }
        return $this->render('@SeraphMenu/back/menuItem/modify.html.twig', array('form' => $form->createView(), 'menu' => $menu));
    }

    /**
     * @Route(name="seraph-delete-menuItem", path="/menu/{id_menu}/menuItem/delete/{id_menuItem}")
     */
    public function deleteMenuItem($id_menu, $id_menuItem)
    {
        $menuItem = $this->getDoctrine()->getRepository(MenuItem::class)->find($id_menuItem);

        $this->getDoctrine()->getManager()->remove($menuItem);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('seraph-list-menu', array('id_menu' => $id_menu));
    }
}