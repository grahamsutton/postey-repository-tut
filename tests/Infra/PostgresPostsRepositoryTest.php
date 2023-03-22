<?php

namespace Postey\Tests;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Postey\Infra\PostgresPostsRepository;

class PostgresPostsRepositoryTest extends TestCase
{
    public function testAllReturnsAnEmptyPostCollectionIfNoPostsAreFound(): void
    {
        $stmt = $this->getMockBuilder(PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stmt->expects($this->once())
            ->method('fetchAll')
            ->willReturn([]);

        $db = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $db->expects($this->once())
            ->method('query')
            ->with(
                $this->equalTo('SELECT * FROM posts')
            )
            ->willReturn($stmt);

        $postsRepo = new PostgresPostsRepository($db);

        $posts = $postsRepo->all();

        $this->assertTrue($posts->isEmpty());
    }

    public function testAllReturnsAPopulatedPostCollectionIfPostsAreFound(): void
    {
        $stmt = $this->getMockBuilder(PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stmt->expects($this->once())
            ->method('fetchAll')
            ->willReturn([
                [
                    'id' => 1,
                    'title' => 'My First Post',
                    'body' => 'This is my first post.'
                ],
                [
                    'id' => 2,
                    'title' => 'My Second Post',
                    'body' => 'This is my second post.'
                ]
            ]);

        $db = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $db->expects($this->once())
            ->method('query')
            ->with(
                $this->equalTo('SELECT * FROM posts')
            )
            ->willReturn($stmt);

        $postsRepo = new PostgresPostsRepository($db);

        $posts = $postsRepo->all();

        $this->assertTrue($posts->isNotEmpty());
    }
}