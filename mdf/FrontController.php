<?php

namespace MDF;


class FrontController {
    private static $_instance = null;

    // decides which router should be invoked
    public function dispatch() {
        $test = new \MDF\Routers\DefaultRouter();
        $test->parse();
    }

    /*
     * @return \MDF\FrontController
     */
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\FrontController();
        }

        return self::$_instance;
    }
}