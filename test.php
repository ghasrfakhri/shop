<?php

require './includes/init.php';


$regiter = new Register();

try {
    $regiter->create("ali3@gmail.com", "123", "Ali", "Ahmadi");
    $msg = "Registration Complete.";
} catch (Exception $e) {
    if ($e->getCode() == 1062) {
        $msg = "Email already in use.";
    }else{
        throw $e;
    }
}


echo $msg;



//echo $twig->render('index.html.twig', array());
        
        