<?php

namespace Flexsim\WebserverSDK;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class WebserverClient
{
    protected $requestHandlerClass;
    protected $xmlParser;
    protected $baseURI;

    public function __construct($baseURI, $options = [])
    {
        $this->baseURI = $baseURI;

        $this->requestHandlerClass = $options['requestHandler'] ?? RequestHandler::class;

        $this->xmlParser = $options['xmlParser'] ?? xml_parser_create();
    }

    public function __call($method, $parameters)
    {
        return $this->handleResponse($this->requestHandler()->$method(...$parameters));
    }

    protected function requestHandler()
    {
        $requestHandlerClass = $this->requestHandlerClass;
        return new $requestHandlerClass($this);
    }

    public static function connect($uri, $options = [])
    {
        return new static($uri, $options);
    }

    protected function handleResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 200) {
            return \xml_parse($this->xmlParser, (string) $response->getBody());
        }

        return $response;
    }
}
