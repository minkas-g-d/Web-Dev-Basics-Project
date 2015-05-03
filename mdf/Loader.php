<?php

namespace MDF;

final class Loader {

    private static $namespaces = array();

    private function __construct() {

    }

    public static function registerAutoload() {
        spl_autoload_register(array('\MDF\Loader', 'autoload'));
    }

    public static function autoload($class) {

        foreach(self::$namespaces as $namespace => $path) {
            if(strpos($class, $namespace) === 0) {
                //echo $namespace.'<br>'.$path.'<br>'.$class.'<br>';

                // Change separator depending on the OS
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                // Replace $class we want to load with its path
                $file = substr_replace($file, $path, 0, strlen($namespace)). '.php';

                // Check if file exists
                $file = realpath($file);
                if($file && is_readable($file)) {
                    include $file;
                } else {
                    throw new \Exception('Cannot include file: ' . $file . '!');
                }
            }
        }

    }

    public static function registerNamespace($namespace, $path) {
        $namespace = trim($namespace);

        if(strlen($namespace) > 0) {
            if(!$path) {
                throw new \Exception(__LINE__ . ': Path not provided');
            }

            $path = realpath($path);
            if($path && is_dir($path) && is_readable($path)) {

                self::$namespaces[$namespace . '\\'] = $path . DIRECTORY_SEPARATOR;

            } else {
                throw new \Exception(__LINE__. ': Invalid path to class directory(namespace)!');
            }

        } else {
            throw new \Exception(__LINE__ . ': Invalid namespace!');
        }
    }

    public static function registerNamespaces($arr) {
        if(is_array($arr)) {
            foreach($arr as $namespace => $path) {
                self::registerNamespace($namespace, $path);
            }
        } else {
            throw new \Exception('Invalid namespaces!');
        }
    }

}