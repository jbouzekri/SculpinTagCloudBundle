<?php

namespace Jb\Bundle\TagCloudBundle\Component\Factory;

/**
 * Description of TagCloudFactory
 *
 * @author jobou
 */
class TagCloudFactory
{
    /**
     * @var string
     */
    protected $tagCloudEntity;

    /**
     * @var string
     */
    protected $tagEntity;

    /**
     * Constructor
     *
     * @param string $tagCloudEntity
     * @param string $tagEntity
     */
    public function __construct($tagCloudEntity, $tagEntity)
    {
        $this->tagCloudEntity = $tagCloudEntity;
        $this->tagEntity = $tagEntity;
    }

    /**
     * Build a TagCloud entity
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function buildTagCloud()
    {
        return new $this->tagCloudEntity();
    }

    /**
     * Build a Tag entity
     *
     * @param string $tag
     * @param int $counter
     * @param string $permalink
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function buildTag($tag, $counter, $permalink)
    {
        $tagObject = new $this->tagEntity();
        $tagObject->setTag($tag);
        $tagObject->setCounter($counter);
        $tagObject->setPage($permalink);

        return $tagObject;
    }
}
