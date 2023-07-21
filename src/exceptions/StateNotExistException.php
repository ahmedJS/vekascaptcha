<?php


namespace vekascapcha;

class StateNotExistException extends \Exception{
    protected $message = "state not exists try to make session firstly";
}