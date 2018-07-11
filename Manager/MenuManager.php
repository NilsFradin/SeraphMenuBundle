<?php

namespace Seraph\Bundle\MenuBundle\Manager;

use Seraph\Bundle\MenuBundle\Form\Type\MenuItemOrderingType;
use Symfony\Component\Form\FormFactoryInterface;

class MenuManager
{
    protected $depthMax;

    protected $depthInitial;

    protected $formFactory;

    public function __construct(FormFactoryInterface $formFactory, $depthMax = 4 )
    {
        $this->formFactory = $formFactory;
        $this->depthMax = $depthMax;
    }

    public function generateForms($items)
    {
        $forms = array();

        if (count($items) < 1)
        {
            return $forms;
        }

        $this->depthInitial = $items[0]->getDepth();
        $this->processDepth($forms, $items);

        return $forms;
    }

    public function drawNodeForm(&$forms, $item)
    {
        $form = $this->formFactory->createNamed("menu_item_organize_".rand(), MenuItemOrderingType::class, $item);
        $forms[] = $form->createView();
    }

    public function processDepth(&$forms, $items)
    {
        foreach ($items as $item)
        {
            $this->drawNodeForm($forms, $item);

            if ($item->getDepth() + 1 < $this->depthInitial + $this->depthMax)
            {
                $this->processDepth($forms, $item->getChildren());
            }
        }
    }
}