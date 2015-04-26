<?php

namespace MDF;


class App {
    private static $_instance = null;

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