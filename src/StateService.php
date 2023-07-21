<?php


namespace vekascapcha;

use Closure;
use vekascapcha\exceptions\NotFoundException;
use vekascapcha\interfaces\DeletableCache;
use vekascapcha\interfaces\ExtendedRequestInterface;
use vekascapcha\interfaces\Ig;
use vekascapcha\State;

class StateService {
  /**
   * @param DeletableCache $cache delete capable cash interface library
   * @param Closure $getStateName `must` returning string which is the filename of the record
   */
    function __construct(
        private DeletableCache $cache,
        private Closure $getStateName
    ){}

  /**
   * @throws StateNotExistException `when state is not exists`
   */
  function getState(ExtendedRequestInterface $req) : State | bool{
    try {
      $state = $this->cache->get(($this->getStateName)($req));
    } catch (NotFoundException $e) {
      throw new StateNotExistException;
    }
    return $state ? $state = unserialize($state) : null;
  }
  
  // function deleteState(ServerRequestInterface $req) : bool{}
  function createState(Ig $ig,int $time,string $uri) : State {
    return StateFactory::createState($time,$ig->generate(),$uri);
  }

  function saveState(State $state,ExtendedRequestInterface $req): bool {
    return $this->cache->set([($this->getStateName)($req)=>serialize($state)]);
  }

  function deleteState(ExtendedRequestInterface $req) : bool{
    return $this->cache->remove(($this->getStateName)($req));
  }

 
}