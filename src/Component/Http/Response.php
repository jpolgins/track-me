<?php

namespace TrackMe\Component\Http;


final class Response
{
    public const HTTP_OK                    = 200;
    public const HTTP_NOT_FOUND             = 400;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var mixed
     */
    private $content;

    /**
     * Response constructor.
     *
     * @param string    $content
     * @param int       $status
     */
    public function __construct($content = '', int $status = self::HTTP_OK)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        $this->content = $content;
    }

    /**
     * @param $content
     *
     * @return Response
     */
    public static function ok($content): Response
    {
        return new self($content, self::HTTP_OK);
    }

    /**
     * @param $content
     *
     * @return Response
     */
    public static function notFound($content): Response
    {
        return new self($content, self::HTTP_NOT_FOUND);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->content);
    }

    /**
     * @return mixed|string
     */
    public function getContent()
    {
        return $this->content;
    }
}