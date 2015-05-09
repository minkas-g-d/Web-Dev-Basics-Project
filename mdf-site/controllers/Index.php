<?php

namespace Controllers;

use MDF\BaseModel;

class Index extends \MDF\BaseController {

    public function index() {
        $postsModel = new \Models\Posts();
        $posts = $postsModel->listPartialInfo();

        $this->view->appendToLayout('body', 'index');
        $this->view->display('layouts.default', array('posts' => $posts));
    }
}