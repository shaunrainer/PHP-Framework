<?php

/*
    * Set Global settings
*/
$GLOBALS['config'] = array(

    'debug_mode' => true,
    'db' => array(
        'name'      => '',
        'user'      => '',
        'password'  => '',
        'host'      => ''
    ),
    'facebook' => array(
        'app_id'        => '1121840731212166',
        'app_secret'    => 'b0e7c47f0c4e4565c72a200417e324f8'
    )

);

/*
    * Define paths
*/

define('CONTROLLER_PATH', ROOT .'/app/controllers/');
define('MODEL_PATH', ROOT .'/app/models/');
define('VIEW_PATH', ROOT .'/app/views/');


/*
    * If debug mode is true then display errors
*/
if($GLOBALS['config']['debug_mode']) {
    error_reporting(E_ALL);
    ini_set("display_errors", 'On');
}