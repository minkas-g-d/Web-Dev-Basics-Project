<?php

namespace Controllers;

class Index {
    public function index() {

        $view = \MDF\View::getInstance();

        // Test Validator
        //$validator = new \MDF\Validator();
        //$validator->setRule('email', 'mina.dodunekova@gmail.com')->setRule('minlength', 3);
        //print_r($validator->getErrors());
        //var_dump(\MDF\Validator::email('mina.dodunekova@gmail.com'));

        $view->appendToLayout('body', 'index');
        $view->display('layouts.default', array('username'=> 'Mina'));
    }
}