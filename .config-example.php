<?php

namespace cf;

class config
{
    const YII_DEBUG = true;
    const YII_ENV = 'dev'; # available values : 'prod', 'dev', 'test'

    const DB_HOST_DASHBOARD = 'localhost';
    const DB_PORT_DASHBOARD = '3306';
    const DB_NAME_DASHBOARD = 'p2p_dashboard';
    const DB_USERNAME_DASHBOARD = 'root';
    const DB_PASSWORD_DASHBOARD = 'root';
    const DB_CHARSET_DASHBOARD = 'utf8';

    const DB_HOST_SWITCHER = 'localhost';
    const DB_PORT_SWITCHER = '3306';
    const DB_NAME_SWITCHER = 'p2p_switcher';
    const DB_USERNAME_SWITCHER = 'root';
    const DB_PASSWORD_SWITCHER = 'root';
    const DB_CHARSET_SWITCHER = 'utf8';

    const DB_HOST_LOG = 'localhost';
    const DB_PORT_LOG = '3306';
    const DB_NAME_LOG = 'p2p_log';
    const DB_USERNAME_LOG = 'root';
    const DB_PASSWORD_LOG = 'root';
    const DB_CHARSET_LOG = 'utf8';

    const PHP_PATH = '/usr/local/bin/php';
    const BASH_REDIRECT = '>> /dev/null &';
    
    const CURL_CONNECT_TIMEOUT = 5;
    const CURL_TIMEOUT = 5;
 
    const WSDL_BY_PASS = 1;
    const WSDL_BY_PASS_EXPECTED_RETURN = '00';

    const WSDL_DIRECT_URL = 'http://sample/server';
    const WSDL_CONNECT_TIMEOUT = 3;
    const WSDL_TIMEOUT = 3;
    const WSDL_USE_PROXY = false;
    const WSDL_PROXY_TYPE = CURLPROXY_SOCKS5;
    const WSDL_PROXY_URL = 'http://localhost:8080';

    // SIMULATOR
    const NOTIF_TRX_URL = 'http://p2p-lender.dev/accountStatement.do';

    // BOT
    const TELEGRAM_TOKEN = '721833702:AAGnAAzFP5RkGegSAkNVr2Ff5vJUtWFjz5E';
    const TELEGRAM_TARGET = '-1001313125030';
}