<?php

/**
 * Main Controller
 */

class Controller
{
    function view(string $view, array $data = []): void
    {
        extract($data);
        $filename = "../app/views/" . $view . ".view.php";

        if(file_exists($filename)){
            require_once $filename;
        }else{
            echo "Could not find view: " . $filename;
        }
    }
}
