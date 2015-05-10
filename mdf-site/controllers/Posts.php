<?php

namespace Controllers;


class Posts extends \MDF\BaseController {

    public function index() {
        $postsModel = new \Models\Posts();
        $posts = $postsModel->listPartialInfo();
        $session = $this->app->getSession();

        $this->view->appendToLayout('body', 'blog');
        $this->view->display('layouts.default',
            array(
                'posts' => $posts,
                'is_logged' => $this->isLogged(),
                'uname' => $session->uname,
                'nav' => 'all-posts'
            )
        );
    }

    public function view($args = null) {
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
            $this->view->display('layouts.default', array('post' => $post, 'is_logged' => $this->isLogged()));

        } catch(\Exception $ex) {
            \MDF\App::getInstance()->displayError(404); exit();
        }

    }
}