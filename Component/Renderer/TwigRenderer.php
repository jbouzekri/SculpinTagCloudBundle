<?php

namespace Jb\Bundle\TagCloudBundle\Component\Renderer;

use Jb\Bundle\TagCloudBundle\Component\Manager\TagCloudManager;

/**
 * Description of TwigRenderer
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class TwigRenderer extends \Twig_Extension
{
    private $manager;

    private $environment;

    public function __construct(TagCloudManager $manager)
    {
        $this->manager = $manager;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('tag_cloud', array($this, 'renderTagCloud'), array('is_safe' => array('html'))),
        );
    }

    public function renderTagCloud($template = 'tag_cloud.html')
    {
        return $this->environment->render($template, array(
            'tag_cloud' => $this->manager->generateTagCloud()
        ));
    }

    public function getName()
    {
        return 'jb_tag_cloud';
    }
}
