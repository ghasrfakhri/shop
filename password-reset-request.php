<?php

require './includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = new Register();
    $email = escapeString($_POST['email']);
    $register->passwordResetRequest($email);
}
echo $twig->render('password-reset-request.html.twig');
