<?php

/**
 * 404 - page not found
 */

class _404 extends Controller
{
    public function index()
    {
        $data['title'] = "404";
        $this->view('errors/404', $data);
    }
}
