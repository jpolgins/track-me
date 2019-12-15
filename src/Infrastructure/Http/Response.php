<?php

declare(strict_types=1);

namespace TrackMe\Infrastructure\Http;

final class Response
{
    public const HTTP_OK = 200;
    public const HTTP_NOT_FOUND = 400;

    private $content;

    public function __construct($content = null, int $status = self::HTTP_OK)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        $this->content = $content;
    }

    public static function success($content): self
    {
        return new self($content, self::HTTP_OK);
    }

    public static function notFound($content): self
    {
        return new self($content, self::HTTP_NOT_FOUND);
    }

    public function __toString(): string
    {
        return (string) json_encode($this->content, JSON_THROW_ON_ERROR);
    }

    public function content()
    {
        return $this->content;
    }
}
