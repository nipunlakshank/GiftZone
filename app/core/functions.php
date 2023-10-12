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

function init_session(): void
{
    $_SESSION['exp'] = time() + intval(SESSION_LIFETIME);
}

function validate_session(): void
{
    if (!Auth::logged_in()) return;
    if (!empty($_SESSION['exp']) && $_SESSION['exp'] > time()) {
        $_SESSION['exp'] += intval(SESSION_LIFETIME);
        return;
    }
    Auth::logout();
}

function redirect(string $link): void
{
    header("Location: " . ROOT . "/$link");
    exit;
}

function message($msg = '', $erase = false)
{

    if (!empty($msg)) {
        $_SESSION['msg'] = $msg;
        return;
    }

    if (!empty($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        if ($erase) {
            unset($_SESSION['msg']);
        }
        return $msg;
    }

    return false;
}

function esc($str): string
{
    return nl2br(htmlspecialchars($str));
}

function filter($item): bool
{
    if (str_contains(strtolower($item->name), strtolower(Shop::get_keyword())))
        return true;

    return false;
}
