<?php

namespace Seraph\Bundle\MenuBundle\Controller;

use Doctrine\Common\Persistence\ManagerRegistry;
use Seraph\Bundle\MenuBundle\Entity\Menu;
use Seraph\Bundle\MenuBundle\Form\Type\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MenuController extends Controller
{
    /**
     * @Route(name="seraph-list-menu", path="/menu/list")
     */
    public function listMenu(ManagerRegistry $registry, Request $request)
    {
        $repository = $registry->getRepository(Menu::class);
        $queryMenu = $repository->createQueryBuilder('m')
            ->orderBy('m.name', 'ASC');
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryMenu->getQuery(),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('@SeraphMenu/back/menu/list.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route(name="seraph-add-menu", path="/menu/add")
     */
    public function addMenu(ManagerRegistry $registry, Request $request)
    {
        $menu = new Menu();

        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ){
            $registry->getManager()->persist($menu);
            $registry->getManager()->flush();

            return $this->redirectToRoute('seraph-list-menu');
        }

        return $this->render('@SeraphMenu/back/menu/modify.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(name="seraph-edit-menu", path="/menu/edit/{id_menu}")
     */
    public function editMenu(ManagerRegistry $registry, Request $request, $id_menu)
    {
        $menu = $registry->getRepository(Menu::class)->find($id_menu);
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $registry->getManager()->persist($menu);
            $registry->getManager()->flush();

            return $this->redirectToRoute('seraph-list-menu');
        }
        return $this->render('@SeraphMenu/back/menu/modify.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(name="seraph-delete-menu", path="/menu/delete/{id_menu}")
     */
    public function deleteMenu(ManagerRegistry $registry, $id_menu)
    {
        $menu = $registry->getRepository(Menu::class)->find($id_menu);
        $registry->getManager()->remove($menu);
        $registry->getManager()->flush();

        return $this->redirectToRoute('seraph-list-menu');
    }
}