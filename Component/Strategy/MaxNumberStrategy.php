<?php

namespace Jb\Bundle\TagCloudBundle\Component\Strategy;

/**
 * MaxNumberStrategy
 *
 * @author jobou
 */
class MaxNumberStrategy implements StrategyInterface
{
    /**
     * @var int
     */
    protected $maxNumber;

    /**
     * Constructor
     *
     * @param int $maxNumber
     */
    public function __construct($maxNumber = 0)
    {
        $this->maxNumber = $maxNumber;
    }

    /**
     * Calculate the weight of the tag
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud
     */
    public function process(\Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud)
    {
        if ($this->maxNumber > 0) {
            $cloud->slice(0, $this->maxNumber);
        }
    }
}

