<?php

function show(mixed $param): void
{
    echo "<pre>";
    print_r($param);
    echo "</pre>";
}

function get_value(string $key): string
{
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
    return "";
}

function redirect(string $link): void
{
    header("Location: ". ROOT ."/$link");
    exit;
}

function message($msg = '', $erase = false){

    if(!empty($msg)){
        $_SESSION['msg'] = $msg;
        return;
    }

    if(!empty($_SESSION['msg'])){
        $msg = $_SESSION['msg'];
        if($erase){
            unset($_SESSION['msg']);
        }
        return $msg;
    }

    return false;

}

