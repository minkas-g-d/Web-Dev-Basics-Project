<?php

namespace Controllers;


class Posts extends \MDF\BaseController {

    public function index() {
        $postsModel = new \Models\Posts();
        $posts = $postsModel->listPartialInfo();

        $this->view->appendToLayout('body', 'blog');
        $this->view->display('layouts.default', array('posts' => $posts));
    }

    public function view($args = null) {
        //var_dump($args);
        if($args == null) {
            $this->index(); exit;
        }

        $postsModel = new \Models\Posts();

        try{
            $post = $postsModel->getPost($args[0]);

            //no record 404
            if(!$post) {
                \MDF\App::getInstance()->displayError(404); exit();
            }

            $this->view->appendToLayout('body', 'post');
            $this->view->display('layouts.default', array('post' => $post));

        } catch(\Exception $ex) {
            \MDF\App::getInstance()->displayError(404); exit();
        }

    }
}