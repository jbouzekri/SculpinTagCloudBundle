<?php

namespace Jb\Bundle\TagCloudBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
    * {@inheritdoc}
    */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('jb_tag_cloud');

        $rootNode
            ->children()
                ->scalarNode('tag_entity')
                    ->defaultValue('Jb\Bundle\TagCloudBundle\Model\Tag')
                ->end()
                ->scalarNode('tag_cloud_entity')
                    ->defaultValue('Jb\Bundle\TagCloudBundle\Model\TagCloud')
                ->end()
                ->arrayNode('strategies')
                    ->prototype('scalar')->end()
                    ->defaultValue(array(
                        'jb_sculpin.tag_cloud.strategy.shuffle',
                        'jb_sculpin.tag_cloud.strategy.percent_size'
                    ))
                ->end()
            ->end();
        ;

        return $treeBuilder;
    }
}
