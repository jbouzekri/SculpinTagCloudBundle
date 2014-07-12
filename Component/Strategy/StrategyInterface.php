<?php

namespace Jb\Bundle\TagCloudBundle\Component\Strategy;

/**
 * StrategyInterface
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
interface StrategyInterface
{
    /**
     * Apply transformation to the tag cloud object
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud
     */
    public function process(\Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud);
}
