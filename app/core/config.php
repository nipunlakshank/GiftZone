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

// Root path — injectable via the PUBLIC_ROOT env var (see docker-compose.yml);
// falls back to per-environment defaults when running outside Docker.
$default_root = ($_SERVER['SERVER_NAME'] == 'localhost')
    ? "http://localhost/public"
    : "https://www.giftzone.com";
define("ROOT", getenv('PUBLIC_ROOT') ?: $default_root);

/**
 * Database config
 *
 * Credentials are injected via environment variables (see docker-compose.yml).
 * The fallbacks only apply when running outside Docker without env vars set.
 * NOTE: php-fpm clears the environment by default, so docker/zz-fpm.conf sets
 * `clear_env = no` to keep these getenv() calls working inside the container.
 */
define("DB_HOST", getenv('DB_HOST') ?: "localhost");
define("DB_NAME", getenv('DB_NAME') ?: "giftzone_db");
define("DB_USER", getenv('DB_USER') ?: "root");
define("DB_PASSWORD", getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "");
define("DB_DRIVER", getenv('DB_DRIVER') ?: "mysql");
