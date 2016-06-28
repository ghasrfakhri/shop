<?php

class ProductCategory {

    protected $n = 10;

    public function adminCreate($name, $parentId) {
        $query = "INSERT INTO product_category SET "
                . "name='$name', parent_id=$parentId";

        Db::get()->query($query);

        return Db::get()->insert_id;
    }

    public function adminUpdate($id, $name, $parentId) {
        $query = "UPDATE product_category SET "
                . "name='$name', parent_id=$parentId"
                . " WHERE id=$id ";

        Db::get()->query($query);

        return Db::get()->affected_rows;
    }

    public function adminGet($id) {
        $query = "SELECT * FROM product_category WHERE id=$id";
        $result = Db::get()->query($query);

        return $result->fetch_assoc();
    }

    public function adminGetList($parentId, $f = 0) {
        $query = "SELECT * FROM product_category WHERE parent_id=$parentId LIMIT $f, $this->n";
        $result = Db::get()->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function adminGetAllList() {
        $cats = $this->adminGetList(0);
        $cats2 = [];
        foreach ($cats as $k => $c) {
            $subcats = $this->adminGetList($c['id']);
            $cats2[] = $c;
            if (count($subcats) > 0) {
                foreach ($subcats as $cc) {
                    $cc['name'] = "---- ".$cc['name'];
                    $cats2[] = $cc;
                }
            }
        }
//        echo "<pre>";
//        var_dump($cats2);
//        die;
        return $cats2;
    }

    public function adminGetCount($parentId) {
        $query = "SELECT COUNT(*) FROM product_category WHERE parent_id=$parentId";
        $result = Db::get()->query($query);

        $c = $result->fetch_row();
        return $c[0];
    }

}
