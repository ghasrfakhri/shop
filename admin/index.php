<?php

require '../includes/init.php';

checkLogin();

echo $twig->render("admin/index.html.twig");
