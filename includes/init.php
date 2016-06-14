<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function($cn) {
    $file = __DIR__ . "/$cn.class.php";
    if (file_exists($file)) {
        require $file;
    }
});
