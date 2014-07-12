<?php

namespace Jb\Bundle\TagCloudBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Sculpin Tag Cloud Extension.
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class JbTagCloudExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        foreach ($config['strategies'] as $strategy) {
            $manager = $container->getDefinition('jb_sculpin.tag_cloud.manager');
            $manager->addMethodCall('addStrategy', array(new Reference($strategy)));
        }

        $container->setParameter('jb_sculpin.tag_cloud.tag_entity.class', $config['tag_entity']);
        $container->setParameter('jb_sculpin.tag_cloud.tag_cloud_entity.class', $config['tag_cloud_entity']);
    }
}
