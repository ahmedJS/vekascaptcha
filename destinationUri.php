<?php
use vekascapcha\ExtendedRequest;
use vekascapcha\ImageGenerator;
use vekascapcha\RandomGenerator;
use vekascapcha\StateServiceBuilder;

require_once "vendor/autoload.php";

$req = new ExtendedRequest();
$req->setAttribute("CAPCODE",$_GET["code"]);
$req->setUri("http://localhost:8080/destinationUri.php");


$stateServiceBuilder = new StateServiceBuilder;

$stateService = $stateServiceBuilder->build(
    function(ExtendedRequest $req){
        return $req->getAttribute("VCAPTCHA_ID");
    }
);

$app = new vekascapcha\Captcha($stateService,new ImageGenerator,NEW RandomGenerator);


echo $app->resolve($req)?"succeeded":"failure";