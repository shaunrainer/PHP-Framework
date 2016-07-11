<?php

class HomeController extends Controller {

    function __construct()
    {

        parent::__construct();

    }

    function index()
    {
        $data['pageTitle'] = 'Storm MVC';

        $this->render('home', $data);

    }

}