<?php

// lazy/auto load models
spl_autoload_register(function ($class_name) {
    require_once "../app/models/$class_name.php";
});

require_once "config.php";
require_once "functions.php";
require_once "database.php";
require_once "model.php";
require_once "controller.php";
require_once "app.php";
