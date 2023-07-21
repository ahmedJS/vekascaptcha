<?php


namespace vekascapcha;

class RandomGenerator {
    public function generate($length = 6): string
    {
        $original_string = array_merge(range(0, 29), range('a', 'z'), range('A', 'Z'));
        $original_string = implode("", $original_string);
        return substr(str_shuffle($original_string), 0, $length);
    }
}