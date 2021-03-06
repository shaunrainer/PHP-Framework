<?php

    /*
     * Set Root and Start a Sesh
    */

    session_start();
    define('ROOT', dirname(dirname(__FILE__)));

    if($_SERVER['HTTP_HOST'] == 'localhost') {
        define('APP_URL', 'http://' . $_SERVER['HTTP_HOST'] .'/storm');
    } else {
        define('APP_URL', 'http://' . $_SERVER['HTTP_HOST']);
    }

    /*
     * Require essentials
    */

    require ROOT .'/config.php';
    require ROOT .'/vendor/Controller.php';
    require ROOT .'/vendor/Model.php';
    require ROOT .'/vendor/View.php';
    require ROOT .'/vendor/Router.php';
    require ROOT .'/vendor/facebook/autoload.php';
    require ROOT .'/vendor/Start.php';

    /*
     * Lets Start...
    */

    $app = new Start();