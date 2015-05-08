<?php

namespace MDF;

include_once 'Loader.php';
class App {

    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;
    private $_router = null;
    private $_dbConnections = array();
    private $_session = null;

    private function __construct() {
        set_exception_handler(array($this, 'exceptionHandler'));
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


        $sess = $this->_config->app['session'];
        // Check if we should start session right away
        if($sess['autostart']) {
            // Check which type of session is configured to be used and instantiate it
            // Have only native php session for now
            // TODO add dbSession in the future
            if($sess['type'] == 'native') {
                $s = new \MDF\Session\NativeSession($sess['name'], $sess['lifetime'],
                    $sess['path'], $sess['domain'], $sess['security']);
            } else {
                throw new \Exception('Unknown session type!');
            }
            // Provide chance for the programmer to set his own session type
            $this->setSession($s);

        }

        $this->_frontController->dispatch();
    }

    /**
     * @param string $connection
     * @return \PDO
     * @throws \Exception
     */
    public function getDBConnection($connection = 'default') {
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

    /**
     * @return \MDF\Routers\IRouter
     */
    public function getRouter()
    {
        return $this->_router;
    }

    public function setRouter($router)
    {
        $this->_router = $router;
    }

    /**
     * @return \MDF\Session\ISession
     */
    public function getSession() {
        return $this->_session;
    }

    /**
     * @param \MDF\Session\ISession $session
     */
    public function setSession(\MDF\Session\ISession $session) {
        $this->_session = $session;
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

    public function _exceptionHandler(\Exception $ex) {
        if ($this->_config && $this->_config->app['displayExceptions'] == true) {
            echo '<pre>' . print_r($ex, true) . '</pre>';
        } else {
            $this->displayError($ex->getCode());
        }
    }

    public function displayError($error) {
        try {
            $view = \MDF\View::getInstance();
            $view->display('errors.' . $error);
        } catch (\Exception $exc) {
            \MDF\Common::headerStatus($error);
            echo '<h1>' . $error . '</h1>';
            exit;
        }
    }
}