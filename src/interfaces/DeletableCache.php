<?php


namespace vekascapcha\interfaces;

interface DeletableCache extends Cache{
    function remove(string $storageId ) : bool;
}