<?php

class Order {

    public function create($user, Cart $cart) {
        $query = "INSERT INTO `order` SET user_id=$user[id], status='waiting'";
        Db::get()->query($query);
        $id = Db::get()->insert_id;

        $items = $cart->get();
        foreach ($items as $item) {
            $this->createOrderItem($id, $item);
        }

        return $id;
    }

    public function createOrderItem($orderId, $item) {
        $query = "INSERT INTO `order_item` SET order_id=$orderId, product_id=$item[id], count=$item[count],"
                . "price=$item[price]";
        Db::get()->query($query);
    }

}
