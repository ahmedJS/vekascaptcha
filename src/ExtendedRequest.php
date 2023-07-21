<?php 


namespace vekascapcha;
use League\Uri\Contracts\UriInterface;
use vekascapcha\interfaces\ExtendedRequestInterface;
class ExtendedRequest implements ExtendedRequestInterface {
    public array $attribute = [] ;
    private $uri ;
    function getAttribute(string $name) : mixed{
        return $this->attribute[$name];
    }
    function setAttribute(string $name,mixed $value){
        $this->attribute[$name] = $value;
    }

    function getProtocolVersion(){}
    function withProtocolVersion(string $version){}
    function getHeaders(){}
    function hasHeader(string $name){}
    function getHeader(string $name){}
    function getHeaderLine(string $name){}
    function withHeader(string $name, $value){}
    function withAddedHeader(string $name, $value){}
    function withoutHeader(string $name){}
    function getBody(){}
    function withBody(\Psr\Http\Message\StreamInterface $body){}

    function getRequestTarget(){}
      function withRequestTarget(string $requestTarget){}
      function getMethod(){}
      function withMethod(string $method){}
      function getUri(){
        return $this->uri;
      }
      function setUri($uri){
        $this->uri = $uri;
      }
      function withUri(\Psr\Http\Message\UriInterface $uri, bool $preserveHost = false){}
}