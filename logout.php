<?php

require './includes/init.php';

$login = new Login();
$login->logout();

redirect("index.php");

