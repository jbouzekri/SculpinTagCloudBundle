<?php

namespace Jb\Bundle\TagCloudBundle\Component\Strategy;

/**
 * Description of ShuffleStrategy
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class ShuffleStrategy implements StrategyInterface
{
    /**
     * Shuffle the tag in the cloud
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud
     */
    public function process(\Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud)
    {
        $keys = array_keys($cloud->getTags());
        shuffle($keys);

        $new = array();
        $old = $cloud->getTags();

        foreach($keys as $key) {
            $new[$key] = $old[$key];
        }

        $cloud->setTags($new);
    }
}
