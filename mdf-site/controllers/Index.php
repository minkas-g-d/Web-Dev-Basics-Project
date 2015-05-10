<?php

namespace Controllers;

use MDF\BaseModel;

class Index extends \MDF\BaseController {

    public function index() {
        $postsModel = new \Models\Posts();
        $posts = $postsModel->listPartialInfo();
        $session = $this->app->getSession();

        $this->view->appendToLayout('body', 'index');
        $this->view->display('layouts.default',
            array(
                'posts' => $posts,
                'is_logged' => $session->is_logged,
                'uname' => $session->uname,
                'nav' => 'home'
            )
        );
    }
}