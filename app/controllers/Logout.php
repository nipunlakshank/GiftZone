<?php

/**
 * Logout controller
 */

class Logout extends Controller
{

    function index()
    {
        Auth::logout();
        redirect('home');
    }

}
