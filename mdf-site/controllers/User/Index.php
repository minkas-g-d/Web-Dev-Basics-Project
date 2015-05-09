<?php

namespace Controllers\User;

class Index extends \MDF\BaseController {

    public function index() {
        echo 'User profile';
    }

    public function addPost() {

        $this->view->appendToLayout('body', 'user.add-post');
        $this->view->display('layouts.default');

    }

    public function addNewPost() {
        $postModel = new \Models\Posts();
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        //$id = \MDF\App::getInstance()->getSession();
        // hardcoding the id for now
        $id = 3;

        $lastInsertedId = $postModel->addPost($id, $title, $content);

        if(\MDF\Validator::numeric($lastInsertedId)) {
            $result['success'] = 'Checkout your fresh post';
            $result['postId'] = $lastInsertedId;
        } else {
            $result['error'] = 'Post failed to save. Please try again.';
        }

        echo json_encode($result);
    }

    public function logout() {
        $session = \MDF\App::getInstance()->getSession();
        $session->destroySession();

        $result = array();

        if($session->getSessionId() != '') {
            $result ['success'] = 'You are successfully logged out!';
        } else {
            $result ['error'] = 'Sorry, we could not log you out!';
        }
        echo json_encode($result);
    }
}