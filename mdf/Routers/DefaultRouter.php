<?php
/**
 * Created by PhpStorm.
 * User: minkas_g_d
 * Date: 30.4.2015 г.
 * Time: 7:49
 */

namespace MDF\Routers;


class DefaultRouter {

    public function parse() {
        //echo '<pre>'.print_r($_SERVER, true).'</pre>';
        //some information servers do not return the $_SERVER['REQUEST_URI'] that is why I use $_SERVER['PHP_SELF']
        $uri = substr(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']), 1);
        //echo $uri;

        $controller = null;
        $method = null;

        $params = explode('/', $uri);
        //var_dump($params);

        if($params[0]) {
            $controller = $params[0];
            if($params[1]) {
                $method = $params[1];
            }
        } else {
            $controller = 'index';
            $method = 'index';
        }

        echo 'controller: '. $controller . '<br>' . 'method: ' . $method;

    }

}