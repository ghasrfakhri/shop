<?php

require './includes/init.php';

$id = (int) $_GET['id'];
$token = escapeString($_GET['token']);

$register = new Register();
if ($register->isValidToken($id, $token)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['password'] === $_POST['cpassword']) {
            $password = escapeString($_POST['password']);
            $register->setPassword($id, $password);
            $register->removeToken($id, $token);
            addFlashMessage("Password reset complete.");
            redirect("index.php");
        } else {
            addFlashMessage("Password and confirm password are not equal");
            redirect($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
        }
    }
    echo $twig->render('password-reset.html.twig');
} else {
    addFlashMessage("Invalid token");
    redirect("index.php");
}

