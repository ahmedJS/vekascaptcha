<?php


namespace vekascapcha;

class ImageGeneratorResult{
    function __construct(
        public  string $code,
        public  string $image,
        public  string $extension
    ) {}

    function __serialize() : array{
        return [
            "code" => $this->code,
            "image" => $this->image,
            "extension" => $this->extension
        ];
    }

    function __unserialize(array $arr):void {
        $this->code = $arr["code"];
        $this->image = $arr["image"];
        $this->extension = $arr["extension"];
    }
}