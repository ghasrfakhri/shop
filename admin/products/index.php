<?php

require '../../includes/init.php';
checkAdmin();

$product = new Product();



echo $twig->render("admin/products/index.html.twig", [
    'products' => $product->adminGetList(),
]);
