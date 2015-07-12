<?php

namespace Jb\Bundle\TagCloudBundle\Component\Strategy;

/**
 * Description of AlphaStrategy
 *
 * @author Tim Broder <timothy.broder@gmail.com>
 */
class AlphaStrategy implements StrategyInterface
{
    /**
     * Sort the tag in the cloud
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud
     */
    public function process(\Jb\Bundle\TagCloudBundle\Model\TagCloud $cloud)
    {
        $keys = array_keys($cloud->getTags());
        asort($keys);

        $new = array();
        $old = $cloud->getTags();

        foreach($keys as $key) {
            $new[$key] = $old[$key];
        }

        $cloud->setTags($new);
    }
}
