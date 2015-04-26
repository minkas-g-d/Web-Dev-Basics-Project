<?php

namespace MDF;

final class Loader {

    private function __construct() {

    }

    public static function registerAutoload() {
        spl_autoload_register(array('\MDF\Loader', 'autoload'));
    }

    public static function autoload($class) {
        echo $class;
    }

}