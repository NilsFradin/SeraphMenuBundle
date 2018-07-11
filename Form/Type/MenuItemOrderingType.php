<?php

namespace Seraph\Bundle\MenuBundle\Form\Type;

use Seraph\Bundle\MenuBundle\Entity\MenuItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemOrderingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('id', null, array('label' => 'Id', 'attr' => array('class' => 'hidden')))
            ->add('position', null, array('label' => 'Position', 'attr' => array('class' => 'form-control')))
            ->add('depth', null, array('label' => 'Profondeur', 'attr' => array('class' => 'hidden')))
            ->add('parent', null, array('choice_label' => 'titleFR', 'label' => 'Parent', 'attr' => array('class' => 'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', MenuItem::class);
    }
}