<?php

namespace Postey\Domain;

use Postey\Domain\Post;
use Iterator;

class PostCollection implements Iterator
{
    private int $position;
    private array $items = [];

    /**
     * Constructor
     * 
     * Enforce that all items provided on initialization are posts.
     *
     * @param array $items = []
     */
    public function __construct(array $items = [])
    {
        $this->position = 0;

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Add a post to the collection.
     *
     * @param \Domain\Post $post
     * @return void
     */
    public function add(Post $post): void
    {
        $this->items[] = $post;
    }

    /**
     * Check if the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this->items) == 0;
    }

    /**
     * Check if the collection has items.
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Get current post.
     *
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    /**
     * Get current index of current post.
     *
     * @return mixed
     */
    public function key(): mixed
    {
        return $this->position;
    }

    /**
     * Reset the pointer to the start of the collection.
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Increment the pointer to the next post.
     *
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Determine if the current element is set and is a post.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->position])
            && $this->items[$this->position] instanceof Post;
    }
}