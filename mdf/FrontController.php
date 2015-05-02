<?php

namespace MDF;


class FrontController {
    private static $_instance = null;

    // decides which router should be invoked
    public function dispatch() {
        $test = new \MDF\Routers\DefaultRouter();
        $test->parse();

        $controller = $test->getController();
        if($controller == null) {
            $controller = $this->getDefaultController();
        }
        $method = $test->getMethod();
        if($method == null) {
            $method = $this->getDefaultMethod();
        }

        echo $controller;
        echo '<br>';
        echo $method;


    }

    public function getDefaultController() {
        $controller = \MDF\App::getInstance()->getConfig()->app['default_controller'];
        if ($controller) {
            return $controller;
        }
        return 'Index';
    }

    public function getDefaultMethod() {
        $method = \MDF\App::getInstance()->getConfig()->app['default_method'];
        if($method) {
            return $method;
        }
        return 'index';
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