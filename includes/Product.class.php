<?php

class Product {

    protected $n = 10;

    public function adminCreate($sku, $name, $description, $price, $quantity, $status = 'visible') {
        $query = "INSERT INTO product SET "
                . "sku='$sku',name='$name', description='$description', "
                . "price='$price', quantity='$quantity', status='$status' ";

        Db::get()->query($query);

        return Db::get()->insert_id;
    }

    public function adminUpdate($id, $sku, $name, $description, $price, $quantity, $status = 'visible') {
        $query = "UPDATE product SET "
                . "sku='$sku',name='$name', description='$description', "
                . "price='$price', quantity='$quantity', status='$status'"
                . "     WHERE id=$id ";

        Db::get()->query($query);

        return Db::get()->affected_rows;
    }

    public function assignCategory($productId, $category_id) {
        try {
            $query = "INSERT INTO products_categories SET "
                    . "product_id=$productId, category_id=$category_id ";

            Db::get()->query($query);
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                return false;
            } else {
                throw $e;
            }
        }
        return true;
    }

    public function adminGet($id) {
        $query = "SELECT * FROM product WHERE id=$id";
        $result = Db::get()->query($query);

        $product = $result->fetch_assoc();
        $product['categories'] = $this->adminGetProductCategories($id);

        return $product;
    }

    public function adminGetProductCategories($id) {
        $query = "SELECT category_id FROM products_categories  WHERE product_id=$id";
        $result = Db::get()->query($query);

        $pc = $result->fetch_all();
        if (count($pc) > 0) {
            foreach ($pc as $c) {
                $cc[] = $c[0];
            }
            $query = "SELECT name FROM product_category  WHERE id in(" . implode(", ", $cc) . ")";
            $result = Db::get()->query($query);

            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function adminGetList($f = 0) {
        $query = "SELECT * FROM product LIMIT $f, $this->n";
        $result = Db::get()->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function adminGetCount() {
        $query = "SELECT COUNT(*) FROM product";
        $result = Db::get()->query($query);

        $c = $result->fetch_row();
        return $c[0];
    }

}
