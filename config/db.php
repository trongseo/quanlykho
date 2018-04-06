<?php
//define('APP_DB', 'easyshopyii');
//define('APP_USERNAME', 'root');
//define('APP_PASSWORD', '');
//define('APP_HOST', 'localhost');
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.APP_HOST.';dbname='.APP_DB,
    'username' => APP_USERNAME,
    'password' => APP_PASSWORD,
    'charset' => 'utf8',
    'tablePrefix' => '',
    'enableSchemaCache' => true,
];
