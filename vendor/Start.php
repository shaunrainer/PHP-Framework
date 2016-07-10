<?php

class Start {

    protected $router;

    function __construct()
    {

        $router = new Router;

        $router->processURL();

    }

}