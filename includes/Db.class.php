<?php

class Db extends mysqli {

    static private $db;

    private function __construct() {
        parent::__construct("localhost", "root", "", "shop_db");
    }

    static function get() {
        if (self::$db === null) {
            self::$db = new Db();
        }

        return self::$db;
    }

}
