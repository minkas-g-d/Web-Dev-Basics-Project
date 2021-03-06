<?php

namespace MDF;


class FrontController {
    private static $_instance = null;
    private $_ns = null;
    private $_controller = null;
    private $_method = null;
    private $_params = array();
    /**
     * @var \MDF\Routers\IRouters
     */
    private $_router = null;

    // loads specific controller and method provided in URI
    public function dispatch() {

        if($this->_router == null) {
            throw new \Exception('Router not provided!');
        }

        $uri = $this->_router->getURI();

        $routes = \MDF\App::getInstance()->getConfig()->routes;
        //print_r($routes);

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

        $inputData = \MDF\InputData::getInstance();
        $params = explode('/', $uri);
        if($params[0]) {
            $this->_controller = strtolower($params[0]);
            if($params[1]) {
                $this->_method = strtolower($params[1]);
                unset($params[0],$params[1]);
                $this->_params = array_values($params);
                $inputData->setGet($this->_params);
            } else {
                $this->_method = $this->getDefaultMethod();
            }
        } else {
            $this->_controller = $this->getDefaultController();
            $this->_method = $this->getDefaultMethod();
        }

        if(is_array($router_cache) && $router_cache['controllers']) {
            if($router_cache['controllers'][$this->_controller]['methods'][$this->_method]) {
                $this->_method = strtolower($router_cache['controllers'][$this->_controller]['methods'][$this->_method]);
            }
            if(isset($router_cache['controllers'][$this->_controller]['to'])) {
                $this->_controller = strtolower($router_cache['controllers'][$this->_controller]['to']);
            }
        }

        $inputData->setPost($this->_router->getPost());
        //var_dump($router_cache);
        // TODO fix the situation when method or controller does not exist
        $controller_to_load = $this->_ns.'\\' . ucfirst($this->_controller);

        try {
            $newController = new $controller_to_load();
        } catch(\Exception $ex) {
            echo $ex->getMessage();
            switch($ex->getMessage()) {
                case 'Cannot include file!': header("Location: /"); break;
                default: \MDF\App::getInstance()->displayError(404);
            }
            exit;
        }

        if(count($this->_params) > 0) {
            $newController->{$this->_method}($this->_params);
        } else {
            $newController->{$this->_method}();
        }

    }

    public function getRouter() {
        return $this->_router;
    }

    public function setRouter(\MDF\Routers\IRouters  $router) {
        $this->_router = $router;
    }

    public function getDefaultController() {
        $controller = \MDF\App::getInstance()->getConfig()->app['default_controller'];
        if ($controller) {
            return strtolower($controller);
        }
        return 'index';
    }

    public function getDefaultMethod() {
        $method = \MDF\App::getInstance()->getConfig()->app['default_method'];
        if($method) {
            return strtolower($method);
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