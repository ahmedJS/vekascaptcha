<?php


namespace vekascapcha\interfaces;

use Psr\Http\Message\ServerRequestInterface;
use vekascapcha\State;
interface Capcha{
    function construct(Cache $cache, Ig $imageGenerator);
    function resolve(ServerRequestInterface $req) : State;
}