<?php

namespace Jb\Bundle\TagCloudBundle\Model;

/**
 * Tag
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class Tag
{
    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
     */
    protected $page;

    /**
     * @var int
     */
    protected $counter = 0;

    /**
     * @var int
     */
    protected $weight;

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set the tag
     *
     * @param string $tag
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get the page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the page
     *
     * @param string $page
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get counter
     *
     * @return int
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * Set counter
     *
     * @param int $counter
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param int $weight
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Increment counter
     *
     * @return \Jb\Bundle\TagCloudBundle\Model\Tag
     */
    public function incCounter()
    {
        $this->counter++;

        return $this;
    }
}
