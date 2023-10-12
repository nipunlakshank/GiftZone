<?php

/**
 * Admin Controller
 */

class Admin extends Controller
{
    public function index(){
        $this->view('admin/dashboard');
    }
}
