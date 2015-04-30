<?php

namespace MDF;


class FrontController {
    private static $_instance = null;

    // decides which router should be invoked
    public function dispatch() {

    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\FrontController();
        }

        return self::$_instance;
    }
}