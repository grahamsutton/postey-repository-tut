<?php

namespace Postey\Domain;

use Postey\Domain\Post;
use Postey\Domain\PostCollection;

interface PostsRepository
{
    /**
     * Fetch all posts.
     *
     * @return \Postey\Domain\PostCollection
     */
    public function all(): PostCollection;

    /**
     * Find a specific post by its ID.
     *
     * @param int $postId
     * @return ?\Postey\Domain\Post
     */
    public function find(int $postId): ?Post;

    /**
     * Save a post.
     *
     * This creates the post if it doesn't exist or updates
     * it if it does.
     *
     * @param \Postey\Domain\Post $post
     * @return \Postey\Domain\Post
     */
    public function save(Post $post): Post;

    /**
     * Delete a specific post by ID.
     *
     * @param int $postId
     * @return void
     */
    public function delete(int $postId): void;

    /**
     * Return the next ID available to unqiuely identify a post.
     *
     * @return int
     */
    public function nextIdentity(): int;
}
