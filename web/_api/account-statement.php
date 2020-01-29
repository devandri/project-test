<?php

require_once __DIR__ . '/../../.config.php';

date_default_timezone_set("asia/jakarta");
set_time_limit(3);
if (\cf\config::YII_ENV != 'prod') {
    ini_set('display_errors', true);
    error_reporting(-1);
    ini_set("soap.wsdl_cache_enabled", 0);
    ini_set('soap.wsdl_cache_ttl', 0);
} else {
    ini_set('display_errors', false);
    error_reporting(0);
}

require_once __DIR__ . '/../../_api/service/AccountStatementServer.php';

$request = file_get_contents('php://input');
$obj = new AccountStatement($request);

ob_start();
$server = new SoapServer(__DIR__ . '/../../_api/_wsdl/BNI_MinionsAccStt.wsdl', ['uri' => 'http://127.0.0.1/']);
$server->setObject($obj);
$server->handle();
$response = ob_get_clean();

$obj->exitWithResponse($response);