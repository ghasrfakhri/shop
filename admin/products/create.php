<?php

require '../../includes/init.php';
checkAdmin();
if (isPost()) {
    $product = new Product();

    $sku = getPostData('sku');
    $name = getPostData('name');
    $description = getPostData('description');
    $price = getPostData('price');
    $quantity = getPostData('quantity');
    $categories = $_POST['categories'];
    $id = $product->adminCreate($sku, $name, $description, $price, $quantity);

    foreach ($categories as $c) {
        $category_id = (int) $c;
        $product->assignCategory($id, $category_id);
    }

    redirect("view.php?id=$id");
}
$category = new ProductCategory();
echo $twig->render("admin/products/create.html.twig", ['categories' => $category->adminGetAllList()]);
