<?php
use PHPUnit\Framework\TestCase;
use vekascapcha\SimpleFileStorage;
class SimpleFileStorageTest extends TestCase {
    function testCreateAndDeleteFile(){
        $file_storage = new SimpleFileStorage(realpath(__DIR__."/../storagepath"));
        $result = $file_storage->set(["somefile" => "contents"]);
        $this->assertTrue($result);
        $deleteResult = $file_storage->remove("somefile");
        $this->assertTrue($deleteResult);
    }
}