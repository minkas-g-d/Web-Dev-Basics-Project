<?php

namespace Controllers;

class Index {
    public function index() {

        $view = \MDF\View::getInstance();
        $view->display('index', array('test'=> array(1,2,3,4,5)));
    }
}