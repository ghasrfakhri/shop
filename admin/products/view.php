<?php

require '../../includes/init.php';


$product = new Product();

$id = (int) $_GET['id'];

echo $twig->render("admin/products/view.html.twig", [
    'product' => $product->adminGet($id)
]);
