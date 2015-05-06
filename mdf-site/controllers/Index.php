<?php

namespace Controllers;

class Index {
    public function index() {

        $view = \MDF\View::getInstance();

        $view->appendToLayout('body', 'index');
        $view->display('layouts.default', array('username'=> 'Mina'));
    }
}