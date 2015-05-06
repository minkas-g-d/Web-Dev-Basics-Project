<?php

namespace Controllers;

class Index {
    public function index() {

        $view = \MDF\View::getInstance();
        $view->display('index');
    }
}