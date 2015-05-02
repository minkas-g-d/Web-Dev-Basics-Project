<?php
/**
 * Created by PhpStorm.
 * User: minkas_g_d
 * Date: 30.4.2015 г.
 * Time: 7:49
 */

namespace MDF\Routers;


class DefaultRouter implements \MDF\Routers\IRouters {


    public function getURI() {
        //echo '<pre>'.print_r($_SERVER, true).'</pre>';
        //some information servers do not return the $_SERVER['REQUEST_URI'] that is why I use $_SERVER['PHP_SELF']
        return substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);
    }

}