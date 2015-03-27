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
    protected $tagCloud = false;

    /**
     * @var \Sculpin\Core\DataProvider\DataProviderInterface
     */
    protected $tagDataProvider;

    /**
     * @var \Jb\Bundle\TagCloudBundle\Component\Factory\TagCloudFactory
     */
    protected $factory;

    /**
     * @var string
     */
    protected $permalinkPattern;

    /**
     * @var array
     */
    protected $strategies = array();

    /**
     * Constructor
     *
     * @param \Sculpin\Core\DataProvider\DataProviderInterface $dataProvider
     * @param \Jb\Bundle\TagCloudBundle\Component\Factory\TagCloudFactory $factory
     * @param string $permalinkPattern
     */
    public function __construct(
        DataProviderInterface $dataProvider,
        TagCloudFactory $factory,
        $permalinkPattern
    ) {
        $this->tagDataProvider = $dataProvider;
        $this->factory = $factory;
        $this->permalinkPattern = $permalinkPattern;
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
    protected function applyStrategies(\Jb\Bundle\TagCloudBundle\Model\TagCloud $tagCloud)
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
    protected function getPermalink($tag)
    {
        return str_replace(':taxon', $tag, $this->permalinkPattern);;
    }
}
