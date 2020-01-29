<?php

date_default_timezone_set("asia/jakarta");

$fl = 'callbacks.log';

if (isset($_GET['empty'])) {
    file_put_contents($fl, '');
    die('emptied');
}

if (isset($_GET['log'])) {
    header('Content-Type: text/plain');
    if (trim(file_get_contents($fl)) == false) {
        die("empty");
    }
    $handle = fopen($fl, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            echo $line.PHP_EOL;
        }
    }
    exit;
}

header('Content-Type: application/json');

$request = file_get_contents('php://input');
file_put_contents($fl, '['.date('Y-m-d H:i:s').']'.$request.PHP_EOL, FILE_APPEND | LOCK_EX);

if (isset($_GET['is_error'])) {
    die('{"status" : "999"}');
}
die('{"status" : "000"}');
