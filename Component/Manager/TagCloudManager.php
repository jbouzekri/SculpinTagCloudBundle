<?php

namespace Jb\Bundle\TagCloudBundle\Component\Manager;

use Sculpin\Core\DataProvider\DataProviderInterface;
use Jb\Bundle\TagCloudBundle\Component\Strategy\StrategyInterface;
use Jb\Bundle\TagCloudBundle\Component\Factory\TagCloudFactory;

/**
 * Description of TagCloudGenerator
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class TagCloudManager
{
    /**
     * @var \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    private $tagCloud = false;

    /**
     * @var \Sculpin\Core\DataProvider\DataProviderInterface
     */
    private $tagDataProvider;

    /**
     * @var \Jb\Bundle\TagCloudBundle\Component\Factory\TagCloudFactory
     */
    private $factory;

    /**
     * @var array
     */
    private $strategies = array();

    public function __construct(DataProviderInterface $dataProvider, TagCloudFactory $factory)
    {
        $this->tagDataProvider = $dataProvider;
        $this->factory = $factory;
    }

    /**
     * Generate a tag cloud (or return the one already generated)
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function generateTagCloud()
    {
        if ($this->tagCloud !== false) {
            return $this->tagCloud;
        }

        $this->tagCloud = $this->factory->buildTagCloud();

        $tags = $this->tagDataProvider->provideData();
        foreach ($tags as $tag => $source) {

            // Hack : Do not display drafts tag (internal)
            if ($tag == 'drafts') {
                continue;
            }

            $counter = count($source);

            $tagObject = $this->factory->buildTag(
                $tag,
                count($source),
                $this->getPermalink($tag)
            );


            $this->tagCloud->addTag($tagObject);
        }

        $this->applyStrategies($this->tagCloud);

        return $this->tagCloud;
    }

    /**
     * Register a strategy
     *
     * @param \Jb\Bundle\TagCloudBundle\Component\Strategy\StrategyInterface $strategy
     *
     * @return \Jb\Bundle\TagCloudBundle\Component\Manager\TagCloudManager
     */
    public function addStrategy(StrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;

        return $this;
    }

    /**
     * Apply all registered strategies
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $tagCloud
     */
    private function applyStrategies(\Jb\Bundle\TagCloudBundle\Model\TagCloud $tagCloud)
    {
        foreach ($this->strategies as $strategy) {
            $strategy->process($tagCloud);
        }
    }

    /**
     * Generate a permalink
     *
     * @param string $tag
     *
     * @return string
     */
    private function getPermalink($tag)
    {
        return '/blog/tags/' . rawurlencode($tag).'/index.html';
    }
}
