<?php

require './includes/init.php';


$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = new Login();

    $email = escapeString($_POST['email']);
    $password = escapeString($_POST['password']);

    if ($login->doLogin($email, $password)) {
        redirect("index.php");
    } else {
        $msg = "Invalid Username or password";
    }
}




echo $twig->render('login.html.twig', array("message" => $msg));
