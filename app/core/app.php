<?php

class App
{
    protected string $controller = '_404';
    protected string $method = 'index';
    public static string $page = '404';

    function __construct()
    {
        validate_session();
        $arr = $this->getURL();
        $filename = "../app/controllers/" . ucfirst($arr[0]) . ".php";
        if (file_exists($filename)) {
            $this->controller = $arr[0];
            self::$page = ucfirst(strtolower($arr[0]));
        }
        $filename = "../app/controllers/" . $this->controller . ".php";
        require $filename;

        $myController = new $this->controller();
        $myMethod = $arr[1] ?? $this->method;

        if (method_exists($myController, strtolower($myMethod))) {
            $this->method = strtolower($myMethod);
            unset($arr[0]);
            unset($arr[1]);
            $arr = [...$arr];
        }

        call_user_func_array([$myController, $this->method], $arr);
    }

    private function getURL(): array
    {
        $url = $_GET['url'] ?? 'home';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $arr = explode('/', $url);
        return $arr;
    }

}