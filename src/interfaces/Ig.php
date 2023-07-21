<?php


namespace vekascapcha\interfaces;
use Psr\Http\Message\ServerRequestInterface;
use vekascapcha\ImageGeneratorResult;

interface Ig{
    function generate() : ImageGeneratorResult;
}