<?php

namespace Jb\Bundle\TagCloudBundle\Model;

/**
 * TagCloud
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class TagCloud implements \Iterator
{
    /**
     * @var array
     */
    private $tags;

    /**
     * @var int
     */
    private $max = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = array();
    }

    /**
     * Add a tag
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\Tag $tag
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function addTag(Tag $tag)
    {
        // Add tag if not existing
        if (!$this->hasTag($tag)) {
            $this->tags[$tag->getTag()] = $tag;
        }

        // Increment counter if no override in the Tag entity
        if ($tag->getCounter() === null) {
            $tag->incCounter();
        }

        // Store the max counter
        if ($tag->getCounter() > $this->max) {
            $this->max = $tag->getCounter();
        }

        return $this;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * set tags
     *
     * @param array $tags
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Check if the tag is already referenced
     *
     * @param \Jb\Bundle\TagCloudBundle\Model\Tag $tag
     *
     * @return boolean
     */
    public function hasTag(Tag $tag)
    {
        return isset($this->tags[$tag->getTag()]);
    }

    /**
     * Position for iterator
     *
     * @var int
     */
    private $position = 0;

    /**
     * Reset iterator
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Iterator current item
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function current()
    {
        $keys = array_keys($this->tags);
        return $this->tags[$keys[$this->position]];
    }

    /**
     * Iterator current position
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Iterator next position
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Iterator item exists
     *
     * @return boolean
     */
    public function valid()
    {
        $keys = array_keys($this->tags);
        return isset($keys[$this->position]) && isset($this->tags[$keys[$this->position]]);
    }

    /**
     * Slice the tag cloud
     *
     * @param int $offset
     * @param int $length
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\TagCloud
     */
    public function slice($offset, $length = null)
    {
        $this->tags = array_slice($this->tags, $offset, $length, true);

        return $this;
    }
}
