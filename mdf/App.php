<?php

namespace MDF;

include_once 'Loader.php';
class App {

    private static $_instance = null;

    private function __construct() {
        \MDF\Loader::registerAutoload();
    }

    public function run() {
        echo 'running';
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