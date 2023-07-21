<?php

use PHPUnit\Framework\TestCase;
use vekascapcha\ImageGenerator;
use vekascapcha\ImageGeneratorResult;

class ImageGeneratorTest extends TestCase{
    function testGenerateImage(){
        $ig = new ImageGenerator();
        $this->assertInstanceOf(ImageGeneratorResult::class,$ig->generate());
    }
}