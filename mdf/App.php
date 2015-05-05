<?php

namespace MDF;

include_once 'Loader.php';
class App {

    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;
    private $_router = null;
    private $_dbConnections = array();

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

    public function getConnection($connection = 'default') {
        if(!$connection) {
            throw new \Exception('No connection identifier provided.', 500);
        }

        if($this->_dbConnections[$connection]) {
            return $this->_dbConnections[$connection];
        }

        $cnf = $this->getConfig()->database;
        if(!$cnf[$connection]) {
            throw new \Exception('No details for establishing connection provided in db config.', 500);
        }

        try {
            $DBH = new \PDO($cnf[$connection]['connection_string'], $cnf[$connection]['username'],
                $cnf[$connection]['password'], $cnf[$connection]['options']);
            $this->_dbConnections[$connection] = $DBH;
        } catch (\PDOException $e) {
            echo $e->getMessage(); exit;
        }

        return $DBH;
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