<?php


namespace vekascapcha\interfaces;
use Psr\Http\Message\RequestInterface;

interface ExtendedRequestInterface extends RequestInterface {
    function getAttribute(string $name) : mixed;
    function setAttribute(string $name,mixed $value);

}