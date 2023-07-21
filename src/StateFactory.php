<?php


namespace vekascapcha;
class  StateFactory {
    static function createState(int $expireDate,ImageGeneratorResult $igr,string $uri): State {
        return new State($expireDate , $igr,$uri);
    }
}