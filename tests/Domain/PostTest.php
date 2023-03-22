<?php

namespace Postey\Tests;

use PHPUnit\Framework\TestCase;
use Postey\Domain\Post;

class PostTest extends TestCase
{
    private Post $post;

    protected function setUp(): void
    {
        $this->post = new Post(1, 'My First Post', 'This is my first post.');
    }

    public function testCanReadIdOfAPost(): void
    {
        $this->assertEquals(1, $this->post->getId());
    }

    public function testCanReadTitleOfAPost(): void
    {
        $this->assertEquals('My First Post', $this->post->getTitle());
    }

    public function testCanReadBodyOfAPost(): void
    {
        $this->assertEquals('This is my first post.', $this->post->getBody());
    }
}
