<?php

use Dotenv\Dotenv;
use Framework\Container;
use Framework\DbConnection;
use Framework\Exceptions\EnvLoadException;

if ( file_exists(dirname(__FILE__).'/vendor/autoload.php') ) {
            require_once dirname(__FILE__) . '/vendor/autoload.php';
        }
try {
    if (file_exists(".env"))
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load(); //все параметры окружения помещаются в массив $_ENV
        // var_dump($_ENV);
    }
    else {
        throw new EnvLoadException();
    }
    session_start(["use_strict_mode" => true]);

    Container::getApp()->run();
}
catch (Exception $e){
    $_SESSION['msg'] = $e->getMessage();
    header('Location: /home');
    exit();
}


    die();
