<?php

/**
 * Session Controller
 */

class Session extends Controller{
    public function index(){
        exit;
    }

    public function validate(){
        if($_SERVER["REQUEST_METHOD"] !== "POST") return;
        validate_session();
        exit(json_encode(["loggedIn" => Auth::logged_in()]));
    }

    public function state(){
        if($_SERVER["REQUEST_METHOD"] !== "GET") return;
        exit(json_encode(["loggedIn" => Auth::logged_in()]));
    }
}

