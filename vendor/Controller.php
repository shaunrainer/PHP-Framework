<?php

class Controller {

    public function __construct()
    {
        
        $this->view = new View;
        
    }
    public function render($name)
    {
        
        $this->view->render($name);
        exit;
        
    }

}