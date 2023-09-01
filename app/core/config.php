<?php

/**
 * App info
 */
define("APP_NAME", "Gifts Zone");
define("APP_DESC", "Description");


if($_SERVER['SERVER_NAME'] == 'localhost'){

    /**
     * Config for Local Server
     */

    // Root path
    define("ROOT", "http://localhost/giftzone/public");

    // Database config
    define("DB_HOST", "localhost");
    define("DB_NAME", "giftzone_db");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DRIVER", "mysql");
}else{

    /**
     * Config for Live Server
     */

    // Root path
    define("ROOT", "https://www.giftzone.com");

    // Database config
    define("DB_HOST", "host");
    define("DB_NAME", "database");
    define("DB_USER", "username");
    define("DB_PASSWORD", "password");
    define("DB_DRIVER", "driver");
}
