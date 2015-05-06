<?php

namespace MDF;


class View {

    private static $_instance = null;
    private $viewPath = null;
    private $viewDir = null;
    private $data = array();
    private $extension = '.php';

    private function __construct() {
        $this->viewPath = \MDF\App::getInstance()->getConfig()->app['viewsDirectory'];

        if($this->viewPath == null) {
            $this->viewPath = realpath('../views/');
        }
    }

    // Dynamically change the view directory
    public function setViewDirectory($path) {
        $path = trim($path);
        if($path) {
            $path = realpath($path) . DIRECTORY_SEPARATOR;
            if(is_dir($path) && is_readable($path)) {
                $this->viewDir = $path;
            } else {
                throw new \Exception('Cannot read views directory.', 500);
            }

        } else {
            throw new \Exception('No view directory provided', 500);
        }
    }

    public function __get($name) {
        return $this->data[$name];
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function display($name, $data = array(), $returnAsString = false) {

        if(is_array($data)) {
            $this->data = array_merge($data, $this->data);
        }

        if($returnAsString) {
            return $this->_includeFile($name);
        } else {
            echo $this->_includeFile($name);
        }

    }

    private function _includeFile($file) {
        if($this->viewDir == null) {
            $this->setViewDirectory($this->viewPath);
        }

        $fl = $this->viewDir . str_replace('.', DIRECTORY_SEPARATOR, $file) . $this->extension;

        if(file_exists($fl) && is_readable($fl)) {
            ob_start();
            include $fl;
            return ob_get_clean();
        } else {
            throw new \Exception('Cannot include view '.$file, 500);
        }
    }


    public static function getInstance() {
        if(self::$_instance == null) {
            self::$_instance = new \MDF\View();
        }

        return self::$_instance;
    }
}