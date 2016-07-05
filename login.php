<?php

require './includes/init.php';


$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = new Login();

    $email = escapeString($_POST['email']);
    $password = escapeString($_POST['password']);

    if ($login->doLogin($email, $password)) {
        if (isset($_SESSION['referer_url'])) {
            $url = $_SESSION['referer_url'];
        } else {
            $url = "index.php";
        }
        redirect($url);
    } else {
        $msg = "Invalid Username or password";
    }
} else {
    if (isset($_SERVER['HTTP_REFERER'])) {
        $_SESSION['referer_url'] = $_SERVER['HTTP_REFERER'];
    } else {
        unset($_SESSION['referer_url']);
    }
}




echo $twig->render('login.html.twig', array("message" => $msg));
