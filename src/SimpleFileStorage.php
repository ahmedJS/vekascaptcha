<?php


namespace vekascapcha;
use vekascapcha\exceptions\NotFoundException;
use vekascapcha\interfaces\DeletableCache;

class SimpleFileStorage implements DeletableCache {
    function __construct(private string $storageDir) {}

	/**
	 * @param string $storageId
	 * @return bool
	 */
	public function remove(string $storageId) : bool{
        if(file_exists($this->storageDir."/$storageId")) {
            return unlink($this->storageDir."/$storageId");
        }
		return false;
	}
	
	/**
	 *
	 * @param string $q
	 * @return string|bool
	 */
	public function get(string $q): string {
		$contents = file_get_contents($this->storageDir."/$q");
		if(is_bool($contents) && $contents=== false) {
			throw new NotFoundException();
		}
        return $contents;
	}
	
	/**
	 *
	 * @param array $records
	 * @return bool
	 */
	public function set(array $record): bool {
        foreach($record as $fileName => $fileContents) {
            return file_put_contents($this->storageDir."/$fileName",$fileContents);
        }
        return false;
	}


}