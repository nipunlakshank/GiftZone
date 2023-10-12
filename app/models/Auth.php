<?php

/**
 * Authentication
 */

class Auth
{
    public static function authenticate(object|array $user): void
    {
        if (is_object($user)) {
            init_session();
            $_SESSION['USER_DATA'] = $user;
            CartData::load();
        }
    }

    public static function logout(): void
    {
        if (!empty($_SESSION['USER_DATA'])) {
            unset($_SESSION['USER_DATA']);
        }
    }

    public static function logged_in(): bool
    {
        if (!empty($_SESSION['USER_DATA'])) {
            return true;
        }
        return false;
    }

    public static function is_admin(): bool
    {
        if (empty($_SESSION['USER_DATA']->role)) {
            return false;
        }

        if ($_SESSION['USER_DATA']->role === 'admin') {
            return true;
        }
        return false;
    }

    public static function __callStatic($name, $arguments)
    {
        $key = str_replace("get_", "", $name);
        $key = str_replace("get", "", strtolower($key));

        if (!empty($_SESSION['USER_DATA']->$key)) {
            return $_SESSION['USER_DATA']->$key;
        }
        return null;
    }
}
