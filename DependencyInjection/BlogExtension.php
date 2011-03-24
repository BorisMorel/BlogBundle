<?php
namespace imag\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
  Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
  Symfony\Component\HttpKernel\DependencyInjection\Extension,
  Symfony\Component\Config\Definition\Processor,
  Symfony\Component\Config\FileLocator;

class BlogExtension extends Extension
{
  public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('notifier.xml');
        
        $configuration = new Configuration();
        $processor = new Processor();
        $config = $processor->process($configuration->getConfigTree(), $configs);
        
        $container->setParameter('imag.blog.notifier.params', $config['notifier']);
    }

}