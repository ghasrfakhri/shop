<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function($cn) {
    $filename = __DIR__ . "/$cn.class.php";
    if (file_exists($filename)) {
        require $filename;
    }
});
