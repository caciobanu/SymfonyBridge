<?php

namespace SimpleBus\SymfonyBridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class CommandBusConfiguration implements ConfigurationInterface
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root($this->alias);
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->enumNode('command_name_resolver_strategy')
                    ->values(['class_based', 'named_message'])
                    ->defaultValue('class_based')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
