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
            throw new \Exception('Could not read config folder.');
        }

        echo $this->_configFolder;
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\Config();
        }

        return self::$_instance;
    }


}