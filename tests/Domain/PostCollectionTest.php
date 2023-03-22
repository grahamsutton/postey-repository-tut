<?php

namespace Postey\Tests;

use PHPUnit\Framework\TestCase;
use Postey\Domain\Post;
use Postey\Domain\PostCollection;
use TypeError;

class PostCollectionTest extends TestCase
{
    public function testCanInitializeAnEmptyCollection(): void
    {
        $posts = new PostCollection();

        $this->assertTrue($posts->isEmpty());
    }

    public function testCanAddPostsOnInitialization(): void
    {
        $posts = new PostCollection([
            new Post(1, 'My First Post', 'This is my first post.'),
            new Post(2, 'My Second Post', 'This is my second post.')
        ]);

        foreach ($posts as $post) {
            $this->assertInstanceOf(Post::class, $post);
        }

        $this->assertCount(2, $posts);
    }

    public function testCannotAddElementsThatAreNotPostsToACollection(): void
    {
        $this->expectException(TypeError::class);

        $posts = new PostCollection();

        $posts->add(123);
    }

    public function testCanIterateOverACollection(): void
    {
        $posts = new PostCollection([
            new Post(1, 'My First Post', 'This is my first post.'),
            new Post(2, 'My Second Post', 'This is my second post.')
        ]);

        foreach ($posts as $post) {
            $this->assertInstanceOf(Post::class, $post);
        }
    }
}
