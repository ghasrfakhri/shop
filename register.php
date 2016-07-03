<?php

require './includes/init.php';


$msg = "";
if (isPost()) {

    $email = escapeString($_POST['email']);
    $password = escapeString($_POST['password']);
    $cpassword = escapeString($_POST['cpassword']);
    $firstname = escapeString($_POST['firstname']);
    $lastname = escapeString($_POST['lastname']);

    $noError = true;
    if ($password != $cpassword) {
        addFlashMessage("رمز و تاییدیه برابر نیست");
        $noError = false;
    }

    if (empty($password)) {
        addFlashMessage("رمز وارد نشده");
        $noError = false;
    }
    if (empty($firstname)) {
        addFlashMessage("نام وارد نشده");
        $noError = false;
    }

    if (empty($lastname)) {
        addFlashMessage("نام خانوادگی وارد نشده");
        $noError = false;
    }

    if (empty($email)) {
        addFlashMessage("ایمیل وارد نشده");
        $noError = false;
    }

    if ($noError == false) {
        redirect($_SERVER['PHP_SELF']);
    }

    $register = new Register();

    if ($register->create($email, $password, $firstname, $lastname)) {
        redirect("login.php");
    } else {
        addFlashMessage("خطایی رخداده");
        redirect($_SERVER['PHP_SELF']);
    }
}




echo $twig->render('register.html.twig', array("message" => $msg));
