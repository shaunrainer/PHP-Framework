<?php

class View {

    public function render($name)
    {

        if( ! file_exists('../app/views/' . $name . '.php')){
            echo "Page not found.";
        }

        require('../app/views/' . $name . '.php');

    }

}