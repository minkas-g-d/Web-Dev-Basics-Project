<?php

namespace Controllers\Admin;

class Index {

    public function index() {
        $view = \MDF\View::getInstance();
        $view->display('admin.index');
    }

    public function profile() {
        echo 'Load profile of user';
    }

}