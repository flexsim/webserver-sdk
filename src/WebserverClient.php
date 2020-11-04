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
        return $this->handleResponse($this->getRequestHandler()->$method(...$parameters));
    }

    protected function getRequestHandler()
    {
        if (\is_null($this->requestHandler)) {
            $this->requestHandler = new RequestHandler($this->baseUri);
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
