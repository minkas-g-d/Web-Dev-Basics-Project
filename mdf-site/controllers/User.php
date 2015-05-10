<?php

namespace Controllers;

class User extends \MDF\BaseController {

    public function index() {
        echo 'User profile';
    }

    public function renderRegister() {
        $this->view->appendToLayout('body', 'register');
        $this->view->display('layouts.default');
    }

    public function register() {
        $uname = $this->input->post('uname');
        $upass = $this->input->post('upass');
        $upConfirm = $this->input->post('upconfirm');
        $email = $this->input->post('email');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');

        $validator = new \MDF\Validator();

        // Check for empty params
        $validator->setRule('required', $uname, null , 'uname')
            ->setRule('required', $upass, null , 'upass')
            ->setRule('required', $upConfirm, null , 'upConfirm')
            ->setRule('required', $email, null , 'email')
            ->validate();

        $result = array();
        if(count($validator->getErrors()) > 0) {
            $result['error'] = 'Please fill all the required fields';
            //$result['all'] = $validator->getErrors();
            echo json_encode($result); exit;

        }
        // Check if passwords match
        if(!$validator->matchesStrict($upass, $upConfirm)) {
            $result['error'] = 'Username and password does not match!';
            echo json_encode($result); exit;
        }

        // Check uname and pass chars
        $validator->setRule('alphanumdash', $uname, null, 'checkUname')
            ->setRule('alphanumdash', $upass, null, 'checkPass')
            ->validate();
        if(count($validator->getErrors()) > 0) {
            $result['error'] = 'Username and password must have only alphanumeric characters and dashes!';
            echo json_encode($result); exit;
        }

        // Check email
        if(!$validator->email($email)) {
            $result['error'] = 'Enter a valid email!';
            echo json_encode($result); exit;
        }

        // Check fname and lname chars
        if($fname != '') {
            if(!$validator->alphadash($fname)) {
                $result['error'] = 'You have some invalid characters in your first name!';
                echo json_encode($result); exit;
            }
        }
        if($lname != '') {
            if(!$validator->alphadash($lname)) {
                $result['error'] = 'You have some invalid characters in your last name!';
                echo json_encode($result); exit;
            }
        }

        $userModel = new \Models\User();

        try{
            $lastInsertedId = $userModel->addUser($uname, $upass, $email, $fname, $lname);

            if($lastInsertedId != 0) {
                $result['success'] = 'Successful registration!';
            } else {
                $result['error'] = 'Registration failed!';
            }

        } catch(\Exception $ex) {
            $result['error'] = $ex->getMessage();
        }

        echo json_encode($result);

    }


    public function renderLogin() {
        $this->view->appendToLayout('body', 'login');
        $this->view->display('layouts.default');
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

    public function renderAddPost() {

        $this->view->appendToLayout('body', 'user.add-post');
        $this->view->display('layouts.default');

    }

    public function addPost() {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        //$id = \MDF\App::getInstance()->getSession();
        // hardcoding the id for now
        $id = 3;

        $postModel = new \Models\Posts();
        $lastInsertedId = $postModel->addPost($id, $title, $content);

        if(\MDF\Validator::numeric($lastInsertedId)) {
            $result['success'] = 'Checkout your fresh post';
            $result['postId'] = $lastInsertedId;
        } else {
            $result['error'] = 'Post failed to save. Please try again.';
        }

        echo json_encode($result);
    }
}