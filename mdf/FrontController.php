<?php

namespace MDF;


class FrontController {
    private static $_instance = null;
    private $_ns = null;
    private $_controller = null;
    private $_method = null;
    private $_params = array();

    // decides which router should be invoked
    public function dispatch() {
        $test = new \MDF\Routers\DefaultRouter();
        $uri = $test->getURI();
        //echo $uri;
        $routes = \MDF\App::getInstance()->getConfig()->routes;

        $router_cache = null;
        if(is_array($routes) && count($routes) > 0) {
            foreach($routes as $key => $value) {
                if(strpos($uri, $key) === 0 && ($uri == $key || strpos($uri, $key.'/') === 0) && $value['namespace']) {
                    $this->_ns = $value['namespace'];
                    $uri = substr($uri, strlen($key) + 1);
                    //echo $uri;
                    $router_cache = $value;
                    break;
                }
            }
        } else {
            throw new \Exception('Cannot load Controller!');
        }


        if($this->_ns == null && $routes['*']['namespace']) {
            $this->_ns = $routes['*']['namespace'];
            $router_cache = $routes['*'];
        } else if($this->_ns == null && !$routes['*']['namespace']) {
            throw new \Exception('No default controller provided!');
        }

        $params = explode('/', $uri);
        if($params[0]) {
            $this->_controller = $params[0];
            if($params[1]) {
                $this->_method = $params[1];
                unset($params[0],$params[1]);
                if(count($params) > 0) {
                    $this->_params = array_values($params);
                }
            } else {
                $this->_method = $this->getDefaultMethod();
            }
        } else {
            $this->_controller = $this->getDefaultController();
            $this->_method = $this->getDefaultMethod();
        }

        if(is_array($router_cache) && $router_cache['controllers'] && $router_cache['controllers'][$this->_controller]['to']) {
            $this->_controller = $router_cache['controllers'][$this->_controller]['to'];
            if($router_cache['controllers'][$this->_controller]['methods']) {
                $this->_method = $router_cache['controllers'][$this->_controller]['methods'][$this->_method];
            } else {
                $this->_method = $this->getDefaultMethod();
            }
        } else {
            $this->_controller = $this->getDefaultController();
        }

//        echo 'router_cache: ';
//        var_dump($router_cache);
//        echo '<br>';
//        echo 'Controller: ' . $this->_controller;
//        echo '<br>';
//        echo 'Method: ' . $this->_method;
//        echo '<br>Params: ';
//        var_dump($this->_params);

        $controller_to_load = $this->_ns.'\\' . ucfirst($this->_controller);
        echo $controller_to_load;
        $newController = new $controller_to_load;
        var_dump($newController);
        $newController->{$this->_method}();
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