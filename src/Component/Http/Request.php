<?php

declare(strict_types=1);

namespace TrackMe\Component\Http;

final class Request
{
    public const HTTP_POST = 'POST';
    public const HTTP_GET = 'GET';

    private string $method;
    private string $requestUri;
    public array $request;

    public function __construct(string $requestUri = '', string $method = '', array $requestData = [])
    {
        $this->requestUri = $requestUri;
        $this->method = $method;
        $this->request = $requestData;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    public static function createFromGlobals(): self
    {
        return new self($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_REQUEST);
    }
}
