<?php

namespace Jb\Bundle\TagCloudBundle\Component\Renderer;

use Jb\Bundle\TagCloudBundle\Component\Manager\TagCloudManager;

/**
 * TwigRenderer
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class TwigRenderer extends \Twig_Extension
{
    /**
     * @var \Jb\Bundle\TagCloudBundle\Component\Manager\TagCloudManager
     */
    private $manager;

    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * Constructor
     *
     * @param \Jb\Bundle\TagCloudBundle\Component\Manager\TagCloudManager $manager
     */
    public function __construct(TagCloudManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Store environment to use template
     *
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Register function
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('tag_cloud', array($this, 'renderTagCloud'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Render a tag cloud
     *
     * @param string $template
     *
     * @return string
     */
    public function renderTagCloud($template = 'tag_cloud.html')
    {
        return $this->environment->render($template, array(
            'tag_cloud' => $this->manager->generateTagCloud()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jb_tag_cloud';
    }
}
