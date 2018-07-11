<?php

namespace Seraph\Bundle\MenuBundle\Form\Type;

use Seraph\Bundle\MenuBundle\Entity\MenuItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('title', null, array('label' => 'Titre', 'attr' => array('class' => 'form-control')))
            ->add('url', null, array('label' => 'Lien', 'attr' => array('class' => 'form-control')))
            ->add('active', null, array('label' => 'Activé', 'attr' => array('class' => '')))
            ->add('target', ChoiceType::class, array('choices' => array('Même fenetre' => '_self', 'Nouvelle fenetre' => '_blank'),'label' => 'Ouverture', 'attr' => array('class' => 'form-control')));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', MenuItem::class);
    }
}