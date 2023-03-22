<?php

namespace Postey\Infra;

use PDO;
use Postey\Domain\Post;
use Postey\Domain\PostCollection;
use Postey\Domain\PostsRepository;

class PostgresPostsRepository implements PostsRepository
{
    /**
     * The PostgreSQL database connection.
     *
     * @var \PDO
     */
    private PDO $db;

    /**
     * Constructor
     *
     * @param \PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetch all posts.
     *
     * @return \Postey\Domain\PostCollection
     */
    public function all(): PostCollection
    {
        $posts = new PostCollection();

        $results = $this->db
            ->query('SELECT * FROM posts')
            ->fetchAll();

        foreach ($results as $result) {
            $posts->add($this->mapToObject($result));
        }

        return $posts;
    }

    /**
     * Find a specific post by its ID.
     *
     * @param int $postId
     * @return \Postey\Domain\Post|null
     */
    public function find(int $postId): ?Post
    {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE id = :id');

        $stmt->execute(['id' => $postId]);

        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $this->mapToObject($result);
    }

    /**
     * Save a post.
     *
     * This creates the post if it doesn't exist or updates
     * it if it does.
     *
     * @param \Postey\Domain\Post $post
     * @return \Postey\Domain\Post
     */
    public function save(Post $post): Post
    {
        $sql = <<<SQL
            INSERT INTO posts (id, title, body)
            VALUES (:id, :title, :body)
            ON CONFLICT (id)
            DO
            UPDATE SET
                title = :title,
                body = :body;
        SQL;

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'body' => $post->getBody()
        ]);

        return $this->find($post->getId());
    }

    /**
     * Delete a specific post by ID.
     *
     * @param string $postId
     * @return void
     */
    public function delete(int $postId): void
    {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE id = :id');

        $stmt->execute(['id' => $postId]);
    }

    /**
     * Return the next ID available to unqiuely identify a post.
     *
     * @return int
     */
    public function nextIdentity(): int
    {
        $stmt = $this->db->prepare("SELECT nextval('posts_id_seq')");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Map a table record from the `posts` table to a \Postey\Domain\Post
     * object.
     *
     * @param array $post
     * @return \Postey\Domain\Post
     */
    private function mapToObject(array $post): Post
    {
        return new Post(
            $post['id'],
            $post['title'],
            $post['body']
        );
    }
}
