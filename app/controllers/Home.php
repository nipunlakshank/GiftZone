<?php

class Home extends Controller
{

    function index()
    {
        $data['var'] = "Data...";
        $this->view("home", $data);
    }

    function edit()
    {
        echo "Edit";
    }
}
