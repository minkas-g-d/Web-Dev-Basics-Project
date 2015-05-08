<?php

namespace Controllers;

class Index extends \MDF\BaseController {

    public function index() {

        // Test Validator
        //$validator = new \MDF\Validator();
        //$validator->setRule('email', 'mina.dodunekova@gmail.com')->setRule('minlength', 3);
        //print_r($validator->getErrors());
        //var_dump(\MDF\Validator::email('mina.dodunekova@gmail.com'));

        $this->view->appendToLayout('body', 'index');
        $this->view->display('layouts.default', array('username'=> 'Mina'));
    }
}