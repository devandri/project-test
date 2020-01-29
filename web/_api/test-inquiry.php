<?php

require_once __DIR__ . '/../../.config.php';

date_default_timezone_set("asia/jakarta");
set_time_limit(3);
if (\cf\config::YII_ENV != 'prod') {
    ini_set('display_errors', true);
    error_reporting(-1);
} else {
    ini_set('display_errors', false);
    error_reporting(0);
}

require_once __DIR__ . '/../../_api/service/InquiryInvestorAccountClient.php';

header('Content-Type: application/json');

$inquiry = new inquiryInvestorAccount(@file_get_contents('php://input'));
ob_start();
echo $inquiry->doInquiry();
$response = ob_get_clean();

$inquiry->exitWithResponse($response);
