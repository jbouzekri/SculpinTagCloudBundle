<?php

namespace Jb\Bundle\TagCloudBundle\Component\Strategy;

/**
 * Description of PercentSizeStrategy
 *
 * @author jobou
 */
class PercentSizeStrategy implements StrategyInterface
{
    /**
     * Calculate the weight of the tag
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud
     */
    public function process(\Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud)
    {
        foreach ($cloud as $tag) {
            $this->setPercentSize($tag, $cloud->getMax());
        }
    }

    /**
     * Set a size
     * @param \Jb\Bundle\TagCloudBundle\Model\Tag $tag
     * @param type $max
     */
    private function setPercentSize(\Jb\Bundle\TagCloudBundle\Model\Tag $tag, $max)
    {
        $percent = ($tag->getCounter() / $max) * 100;

        $weight = floor($percent / 10);

        if ($percent >= 5) {
            $weight++;
        }

        if ($percent >= 80 && $percent < 100) {
            $weight = 8;
        } elseif ($percent == 100) {
            $weight = 9;
        }

        $tag->setWeight($weight);
    }
}

