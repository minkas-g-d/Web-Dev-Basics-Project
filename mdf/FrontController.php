<?php

namespace MDF;


class FrontController {
    private static $_instance = null;
    private $_ns = null;
    private $_controller = null;
    private $_method = null;

    // decides which router should be invoked
    public function dispatch() {
        $test = new \MDF\Routers\DefaultRouter();
        $uri = $test->getURI();
        //echo $uri;
        $routes = \MDF\App::getInstance()->getConfig()->routes;

        if(is_array($routes) && count($routes) > 0) {
            foreach($routes as $key => $value) {
                if(strpos($uri, $key) === 0) {
                    $this->_ns = $value['namespace'];
                    break;
                }
            }
        } else {
            throw new \Exception('Cannot load Controller!');
        }


        if($this->_ns == null && $routes['*']['namespace']) {
            $this->_ns = $routes['*']['namespace'];
        } else if($this->_ns == null && !$routes['*']['namespace']) {
            throw new \Exception('No default controller provided!');
        }

        echo $this->_ns;

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