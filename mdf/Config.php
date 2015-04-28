<?php
namespace MDF;

// knows where our config files are located, loads them, read them
class Config {
    private static $_instance = null;
    private $_configFolder = null;
    private $_configArray = array();

    private function __construct() {
    }

    public function setConfigFolder($configFolder) {
        if(!$configFolder) {
            throw new \Exception('Config folder is empty.');
        }

        $_configFolder = realpath($configFolder);

        if($_configFolder && is_dir($_configFolder) && is_readable($_configFolder)) {
            // clear old config data
            $this->_configArray = array();
            $this->_configFolder = $_configFolder . DIRECTORY_SEPARATOR;
        } else {
            throw new \Exception('Could not read config folder '.$_configFolder.'!');
        }

        //echo $this->_configFolder;
    }

    public function includeConfigFile($path) {
        if(!$path) {
            throw new \Exception('Path to config file not provided');
        }

        $file = realpath($path);

        if($file && is_file($file) && is_readable($file)) {
            //get the filename
            $fileName = explode('.php', basename($file))[0];
            $this->_configArray[$fileName] = include $file;
            print_r($this->_configArray);
        } else {
            throw new \Exception('Could not open file '.$file.'!');
        }

        return null;
    }


    public function __get($name) {
        if(!$this->_configArray[$name]) {
            //TODO
            $this->includeConfigFile($this->_configFolder . $name . '.php');
        }

        if(array_key_exists($name, $this->_configArray)) {
            return $this->_configArray[$name];
        }

        return null;
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\Config();
        }

        return self::$_instance;
    }


}