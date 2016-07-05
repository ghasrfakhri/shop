<?php

require 'includes/init.php';

$product = new Product();

$id = (int) $_GET['id'];
 $product->incVisitCount($id);
 
echo $twig->render("view.html.twig", [
    'product' => $product->get($id)
]);
