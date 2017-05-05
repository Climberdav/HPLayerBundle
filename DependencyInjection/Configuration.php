<?php

namespace ClimberdavHPLayerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('climberdav_hp_layer');;

        $rootNode
            ->children()
                ->scalarNode('host')->defaultNull()->end()
                ->integerNode('port')->defaultValue(8080)->example('8080')->end()
                ->scalarNode('protocol')->defaultValue('http')->example('https or http')->end()
                ->scalarNode('login')->defaultNull()->end()
                ->scalarNode('password')->defaultNull()->end()
                ->scalarNode('root')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
