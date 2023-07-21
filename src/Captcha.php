<?php


namespace vekascapcha;
use vekascapcha\interfaces\ExtendedRequestInterface;
use vekascapcha\interfaces\Ig;
class Captcha {
    public $cookieParameterName = "VCAPTCHA_ID";
    public $captchaCodeParameterName = "CAPCODE";
    public $destinationUriParameter = "DISTINATION_UI";
    public $expireDateParameterName = "VCAPTCHA_EXPIRE_DATE";
    function __construct(
        private StateService $stateService,
        private Ig $ig,
        private RandomGenerator $rg,
        private array $endPoints =array()
        )
    {
     if(empty($endPoints)){
        $this->fillDefaultEndPoints();
     }
    }
    /**
     * @param ExtendedRequestInterface $req the request that contain the data that needed for validation
     * it will take the `url` of the distination and the `identifier` that recognize the user
     * 
     * when resolve : it will return `true` and `remove` the file in the server and remove the `identifier` 
     * when failure : it will `rewrite` the file and `redirect` to the prev url
     */
    function resolve(ExtendedRequestInterface $req) : bool {
        $this->fillUpWithIdAttribute($req);
        $state = $this->stateService->getState($req);
        if($state){
            if($this->isValidState($state) && $this->stateReqCompatibility($req,$state)) {
              ($this->endPoints["success"])($req);
              return  true;
            } else {
              ($this->endPoints["failure"])($req);
              return  false;
            }
        }
        return  false;
    }

    private function endSession(ExtendedRequestInterface $req) {
        $this->stateService->deleteState($req);
        $_COOKIE[$this->cookieParameterName] = "";
    }

    function makeSession(ExtendedRequestInterface $req) : State | bool{

        $destinationUri = $req->getAttribute($this->destinationUriParameter);

        $stateExpireDate = $req->getAttribute($this->expireDateParameterName);

        $sessionName = $this->rg->generate();

        setcookie($this->cookieParameterName,$sessionName);

        $req->setAttribute($this->cookieParameterName,$sessionName);
        
        $state = $this->stateService->createState($this->ig,$stateExpireDate,$destinationUri);

        return $this->stateService->saveState($state,$req)?$state:false;

    }

    /**
     * fill up the request with cookie attribute if it existed
     */
    private function fillUpWithIdAttribute(ExtendedRequestInterface &$req) {
        if(isset($_COOKIE[$this->cookieParameterName])) {
            $req->setAttribute(
                $this->cookieParameterName,
                $_COOKIE[$this->cookieParameterName
            ]);
            return true;
        }
        return false;
    }

    private function stateReqCompatibility(ExtendedRequest $req ,State $state){
        if($req->getUri() != $state->uri) return false;
        if($req->getAttribute($this->captchaCodeParameterName) != $state->igr->code)
            return false;
        return true;
    }

    private function isValidState(State $state) : bool{
        if($state->expireDate < time()) return false;
        return true;
    }

    private function fillDefaultEndPoints(){
        $this->endPoints["success"] = function(ExtendedRequest $req){
            $this->endSession($req);
        };

        $this->endPoints["failure"] = function(ExtendedRequest $req){

        };
    }
}