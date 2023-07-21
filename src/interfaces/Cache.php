<?php


namespace vekascapcha\interfaces;
use vekascapcha\exceptions\NotFoundException;
interface Cache {
    /**
     * @throws NotFoundException
     */
    function get(string $q) : string;

    function set(array $records) : bool;
}