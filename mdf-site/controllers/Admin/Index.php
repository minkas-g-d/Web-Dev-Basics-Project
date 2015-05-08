<?php

namespace Controllers\Admin;

class Index extends \MDF\BaseController{

    public function index() {
        $this->view->display('admin.index');
    }

    public function profile() {
        echo 'Load profile of user';
    }

}