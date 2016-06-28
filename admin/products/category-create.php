<?php

require '../../includes/init.php';

$category = new ProductCategory();
$parentId = getNumParam("parent_id");
if (isPost()) {
    $name = getPostData('name');
    $id = $category->adminCreate($name, $parentId);
    redirect("category-list.php?parent_id=$parentId");
}

$cat = $category->adminget($parentId);
echo $twig->render("admin/products/category-create.html.twig", ["parentName" => $cat['name']]);
