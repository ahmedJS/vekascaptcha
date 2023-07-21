<?php


namespace vekascapcha;

class State{


    /**
     * @param $expireDate
     * @param $valid to determine the record is valid or not
     */
    function __construct(
        public  int $expireDate,
        public  ImageGeneratorResult $igr,
        public string $uri
    ){}

    function __serialize(): array {
        return [
            "expireDate" => $this->expireDate,
            "igr" => serialize($this->igr),
            "uri" => $this->uri
        ];
    }

    function __unserialize(array $arr) {
        $this->expireDate = $arr["expireDate"];
        $this->igr = unserialize($arr["igr"]);
        $this->uri = $arr["uri"];
    }
}