<?php

class Controller {

    public function __construct()
    {
        
        $this->view = new View;
        
    }

    public function render($name, $data = [])
    {
        
        $this->view->render($name, $data);
        exit;
        
    }

}