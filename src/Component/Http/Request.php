<?php

namespace TrackMe\Component\Http;


final class Request
{
    public const HTTP_POST = 'POST';
    public const HTTP_GET  = 'GET';

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $requestUri;

    /**
     * @var array
     */
    public $request;

    /**
     * Request constructor.
     *
     * @param string    $requestUri
     * @param string    $method
     * @param array     $requestData
     */
    public function __construct(string $requestUri = '', string $method = '', array $requestData = [])
    {
        $this->requestUri   = $requestUri;
        $this->method       = $method;
        $this->request      = $requestData;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    /**
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        return new self($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_REQUEST);
    }
}