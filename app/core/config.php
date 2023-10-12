<?php

// Display errors on(1) /off(0)
ini_set('display_errors', 1);


/**
 * Session config
 */
define("SESSION_LIFETIME", 60 * 60 * 24);   // 24 hours
// define("SESSION_LIFETIME", 10);  // 10 seconds


/**
 * App info
 */
define("APP_NAME", "Gift Zone");
define("APP_LOGO", "logo2.png");
define("APP_DESC", "Description");
define("APP_EMAIL", "giftzone@mail.com");
define("APP_TEL", "+94 77 1234 567");
define("APP_ADDRESS", "120, giftzone, Sri Lanka");


/**
 * Server config
 */
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
