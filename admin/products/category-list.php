<?php

require '../../includes/init.php';

checkAdmin();
$category = new ProductCategory();

$parentId = getNumParam('parent_id');

$cat = $category->adminget($parentId);

echo $twig->render("admin/products/category-list.html.twig", [
    'categories' => $category->adminGetList($parentId),
    'parent_id' => $parentId,
    'parentName' => $cat['name'],
]);
