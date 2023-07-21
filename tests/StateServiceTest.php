<?php
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use vekascapcha\ExtendedRequest;
use vekascapcha\ImageGenerator;
use vekascapcha\ImageGeneratorResult;
use vekascapcha\interfaces\ExtendedRequestInterface;
use vekascapcha\SimpleFileStorage;
use vekascapcha\State;
use vekascapcha\StateService;

class StateServiceTest  extends TestCase {
    
    private Closure $getStateName;
    private StateService $stateService;

    function setUp():void{
        $this->getStateName = function(ExtendedRequestInterface $req) {
            return $req->getAttribute("captchaTokens");
        };
        $this->stateService = new StateService(
            new SimpleFileStorage(realpath(__DIR__."/../storagepath")),$this->getStateName);
    }
    function testCreatingState(){
        $state = $this->stateService->createState(new ImageGenerator(),time());
        $this->assertInstanceOf(State::class,$state);
    }
    function testCreateNewStateAndStoreItAndDeleteAfter(){
        $state = $this->stateService->createState(new ImageGenerator(),time());
        $req = new ExtendedRequest();
        $req->setAttribute("captchaTokens","mdsvkjsd989");
        $saved = $this->stateService->saveState($state,$req);
        $this->assertTrue($saved);
        $deleted = $this->stateService->deleteState($req);
        $this->assertTrue($deleted);
    }

    

    
}