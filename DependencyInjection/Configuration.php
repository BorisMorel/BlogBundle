<?php
namespace imag\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition,
  Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
  public function getConfigTree()
  {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('blog');
    $rootNode
      ->children()
        ->arrayNode('notifier')
        ->children()
          ->scalarNode('from')->end()
          ->scalarNode('to')->end()
          ->scalarNode('subject')->end()
          ->scalarNode('body_template')->end()
        ->end()
      ->end();
      
    return $treeBuilder->buildTree();
  }
  
}