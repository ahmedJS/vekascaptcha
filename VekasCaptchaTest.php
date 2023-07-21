<?php

require_once "vendor/autoload.php";

use vekascapcha\ExtendedRequest;
use vekascapcha\ImageGenerator;
use vekascapcha\RandomGenerator;
use vekascapcha\StateServiceBuilder;

$stateServiceBuilder = new StateServiceBuilder;

$stateService = $stateServiceBuilder->build(
    function(ExtendedRequest $req){
        return $req->getAttribute("VCAPTCHA_ID");
    }
);

$app = new vekascapcha\Captcha($stateService,new ImageGenerator,NEW RandomGenerator);

$req = new ExtendedRequest();
$req->setAttribute("DISTINATION_UI","http://localhost:8080/destinationUri.php");
$req->setAttribute("VCAPTCHA_EXPIRE_DATE",time()+(60*60*60));
$state = $app->makeSession($req);
header("Content-Type: image/jpeg");
echo $state->igr->image;