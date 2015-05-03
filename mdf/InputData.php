<?php

namespace MDF;

class InputData {
    private static $_instance = null;
    private $_get = array();
    private $_post = array();
    private $_cookies = array();

    private function __construct() {
        $this->_cookies = $_COOKIE;
    }

    public function setGet($arr) {
        if(is_array($arr)) {
            $this->_get = $arr;
        }
    }

    public function setPost($arr) {
        if(is_array($arr)) {
            $this->_post = $arr;
        }
    }

    // Check whether certain param exists
    public function hasGet($id) {
        return array_key_exists($id, $this->_get);
    }

    // Check whether certain param exists
    public function hasPost($name) {
        return array_key_exists($name, $this->_post);
    }

    public function hasCookies($name) {
        return array_key_exists($name, $this->_cookies);
    }

    public function get($id, $normalize = null, $default = null) {
        if($this->hasGet($id)) {
            if($normalize != null) {
                // TODO normalize
                return \MDF\Common::normalize($this->_get[$id], $normalize);
            }
            return $this->_get[$id];
        }

        return $default;
    }

    public function post($name, $normalize = null, $default = null) {
        if($this->hasPost($name)) {
            if($normalize != null) {
                // TODO normalize
                return \MDF\Common::normalize($this->_post[$name], $normalize);
            }
            return $this->_post[$name];
        }

        return $default;
    }

    public function cookies($name, $normalize = null, $default = null) {
        if($this->hasCookies($name)) {
            if($normalize != null) {
                // TODO normalize
                return \MDF\Common::normalize($this->_cookies[$name], $normalize);
            }
            return $this->_cookies[$name];
        }

        return $default;
    }

    /*
     * @return \MDF\InputData
     */
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\InputData();
        }

        return self::$_instance;
    }
}