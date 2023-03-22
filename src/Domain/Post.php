<?php

namespace Postey\Domain;

class Post
{
    private int $id;
    private string $title;
    private string $body;

    public function __construct(int $id, string $title, string $body)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}