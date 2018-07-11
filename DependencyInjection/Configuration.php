<?php

namespace Seraph\Bundle\MenuBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('id4v_menu');
        $rootNode
            ->children()
                ->arrayNode('admin')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('menu_depth')
                        ->defaultValue('3')
                        ->min(0)
                        ->info('The depth of the tree in back-end menu')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}