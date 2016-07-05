<?php

require './includes/init.php';

$product = new Product();
$products = $product->getList(0, null, ['visit_count DESC']);

$document = new Document();

$document->initDocument("Test");
$document->addTransaction(1, 2, 1000, "test 1", "Test 2");



echo $twig->render('index.html.twig', array("products" => $products));
