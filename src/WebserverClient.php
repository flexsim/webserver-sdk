<?php

namespace Flexsim\WebserverSDK;

use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

class WebserverClient
{
    protected $baseUri;

    protected $requestHandler;

    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function __call($method, $parameters)
    {
        $async = !!\strpos($method, 'Async');

        $method = \explode('Async', $method)[0];

        return $this->handleResponse($this->getRequestHandler($async)->$method(...$parameters));
    }

    protected function getRequestHandler($async)
    {
        if (\is_null($this->requestHandler)) {
            $this->requestHandler = new RequestHandler($this->baseUri, $async);
        }

        return $this->requestHandler;
    }

    public static function connect($uri)
    {
        return new static($uri);
    }

    protected function handleResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 200) {
            return new SimpleXMLElement($response->getBody());
        }

        return $response;
    }
}
