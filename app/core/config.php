<?php

/**
 * App info
 */
define("APP_NAME", "Gift Zone");
define("APP_DESC", "Description");

/**
 * Database config
 */
if($_SERVER['SERVER_NAME'] == 'localhost'){
    // Database config for localhost
    define("DB_HOST", "localhost");
    define("DB_NAME", "giftzone_db");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DRIVER", "mysql");
}else{
    // Database config for live server
    define("DB_HOST", "host");
    define("DB_NAME", "database");
    define("DB_USER", "username");
    define("DB_PASSWORD", "password");
    define("DB_DRIVER", "driver");
}
