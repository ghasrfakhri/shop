<?php

class Cart {

    public function add($id, $count) {
        $cart = $this->getCartArray();
        $cart[$id] += $count;
        if ($cart[$id] < 0) {
            $cart[$id] = 0;
        }
        $_SESSION['cart'] = $cart;
    }

    public function getItemCount() {
        return count($this->getCartArray());
    }

    public function get() {
        $cart0 = $this->getCartArray();
        $product = new Product();
        $cart = [];
        foreach ($cart0 as $id => $count) {
            $p = $product->get($id);
            if ($p['quantity'] > $count) {
                $p['count'] = $count;
            } else {
                $p['count'] = $p['quantity'];
            }
            $cart[] = $p;
        }

        return $cart;
    }

    private function getCartArray() {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        } else {
            return [];
        }
    }

}
