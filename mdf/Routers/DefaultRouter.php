<?php
/**
 * Created by PhpStorm.
 * User: minkas_g_d
 * Date: 30.4.2015 г.
 * Time: 7:49
 */

namespace MDF\Routers;


class DefaultRouter {
    private $_controller = null;
    private $_method = null;
    private $_params = array();


    public function parse() {
        //echo '<pre>'.print_r($_SERVER, true).'</pre>';
        //some information servers do not return the $_SERVER['REQUEST_URI'] that is why I use $_SERVER['PHP_SELF']
        $uri = substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);
        //echo $uri;

        $controller = null;
        $method = null;

        $params = explode('/', $uri);
        //var_dump($params);

        if($params[0]) {
            $this->_controller = ucfirst($params[0]);
            if($params[1]) {
                $this->_method = $params[1];

                // leave only params in the $params array
                unset($params[0], $params[1]);
                $this->_params = array_values($params);

            }
        }

        echo 'controller: '. $this->_controller . '<br>' . 'method: ' . $this->_method;
        var_dump($this->_params);
    }

    public function getController() {
        return $this->_controller;
    }

    public function getMethod() {
        return $this->_method;
    }

    public function getGet() {
        return $this->_params;
    }


}