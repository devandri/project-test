<?php

$db = [
    /* DB DASHBOARD */
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . \cf\config::DB_HOST_DASHBOARD . ';dbname=' . \cf\config::DB_NAME_DASHBOARD,
        'username' => \cf\config::DB_USERNAME_DASHBOARD,
        'password' => \cf\config::DB_PASSWORD_DASHBOARD,
        'charset' => \cf\config::DB_CHARSET_DASHBOARD,
    ],
    /* END DB DASHBOARD */
    /* DB SWITCHER */
    // 'db_switcher' => [
    //     'class' => 'yii\db\Connection',
    //     'dsn' => 'mysql:host='.\cf\config::DB_HOST_SWITCHER.';dbname='.\cf\config::DB_NAME_SWITCHER,
    //     'username' => \cf\config::DB_USERNAME_SWITCHER,
    //     'password' => \cf\config::DB_PASSWORD_SWITCHER,
    //     'charset' => \cf\config::DB_CHARSET_SWITCHER,
    // ],
    /* END DB SWITCHER */
    /* DB LOG */
    // 'db_log' => [
    //     'class' => 'yii\db\Connection',
    //     'dsn' => 'mysql:host='.\cf\config::DB_HOST_LOG.';dbname='.\cf\config::DB_NAME_LOG,
    //     'username' => \cf\config::DB_USERNAME_LOG,
    //     'password' => \cf\config::DB_PASSWORD_LOG,
    //     'charset' => \cf\config::DB_CHARSET_LOG,
    // ],
    /* END DB LOG */
];

if (YII_ENV_PROD) {
    $db['db']['enableSchemaCache'] = true;
    $db['db']['schemaCacheDuration'] = 60;
    $db['db']['schemaCache'] = 'cache';
}

return $db;
