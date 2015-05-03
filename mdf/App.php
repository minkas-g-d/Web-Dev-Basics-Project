<?php

namespace MDF;

include_once 'Loader.php';
class App {

    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;
    private $_router = null;

    private function __construct() {
        \MDF\Loader::registerNamespace('MDF', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \MDF\Loader::registerAutoload();
        $this->_config = \MDF\Config::getInstance();
    }

    /*
     * @return \MDF\Config
     */
    public function getConfig() {
        return $this->_config;
    }

    public function setConfigFolder($path) {
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder() {
        return $this->_config->getConfigFolder();
    }

    public function run() {
        if(!$this->getConfigFolder()) {
            $this->setConfigFolder('../config');
        }

        $this->_frontController = \MDF\FrontController::getInstance();

        // TODO Include check for other routers when available
        if($this->_router == 'DefaultRouter') {
            $this->_frontController->setRouter(new \MDF\Routers\DefaultRouter());
        }

        $this->_frontController->dispatch();
    }

    public function getRouter()
    {
        return $this->_router;
    }

    public function setRouter($router)
    {
        $this->_router = $router;
    }

    /*
     * @return MDF/App
     */

    public static function getInstance() {

        if(!isset(self::$_instance)) {
            self::$_instance = new \MDF\App();
        }

        return self::$_instance;
    }
}