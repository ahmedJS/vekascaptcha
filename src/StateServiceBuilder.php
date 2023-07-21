<?php


namespace vekascapcha;
use vekascapcha\interfaces\DeletableCache;
class StateServiceBuilder {
    private StateService $stateService;
    function build(\Closure $getStateName) : StateService{
        $cache = $this->getCacheLib();
        return $this->stateService = new StateService($cache,$getStateName);
    }

    private function getCacheLib() : DeletableCache{
        return new SimpleFileStorage(realpath(__DIR__."/../storagepath"));
    }


}