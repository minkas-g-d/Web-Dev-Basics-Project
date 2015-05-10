<?php

namespace Controllers;

class User extends \MDF\BaseController {

    public function index() {

        echo 'User profile';
    }

    public function renderRegister() {
        if($this->isLogged()) {
            header('Location: /user/add-post'); exit;
        }

        $this->view->appendToLayout('body', 'register');
        $this->view->display('layouts.default',
            array('is_logged' => $this->isLogged(), 'nav' => 'register'));
    }

    public function register() {
        if($this->isLogged()) {
            header('Location: /user/add-post'); exit;
        }

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
        if($this->isLogged()) {
            header('Location: /user/add-post'); exit;
        }
        $this->view->appendToLayout('body', 'login');
        $this->view->display('layouts.default',
            array('is_logged' => $this->isLogged(), 'nav' => 'login'));
    }

    public function login() {
        if($this->isLogged()) {
            header('Location: /user/add-post'); exit;
        }

        $uname = $this->input->post('uname');
        $upass = $this->input->post('upass');
        $result = array();

        if(!\MDF\Validator::required($uname)) {
            $result['error'] = 'Enter your username!';
            echo json_encode($result); exit;
        }

        if(!\MDF\Validator::required($upass)) {
            $result['error'] = 'Enter your password!';
            echo json_encode($result); exit;
        }

        $userModel = new \Models\User();
        // returns false when record is not found
        $user = $userModel->getUserByName($uname);

        if($user) {
            if(\MDF\Validator::passValidation($upass, $user['pass_hash'])) {
                $session = $this->app->getSession();

                $session->is_logged = true;
                $session->is_admin  = $user['is_admin'];
                $session->uid       = $user['id'];
                $session->uname     = $user['username'];
                $session->email     = $user['email'];
                $session->fname     = $user['firstname'];
                $session->lname     = $user['lastname'];

                $result['success'] = 'Login successful!';

            } else {
                $result['error'] = 'Incorrect password!';
            }
        } else {
            $result['error'] = 'Incorrect username!';
        }

        echo json_encode($result);
    }

    public function logout() {
        $session = \MDF\App::getInstance()->getSession();
        $session->destroySession();
        $result['success'] = 'You are successfully logged out!';

        echo json_encode($result);
    }

    public function renderAddPost() {
        if(!$this->isLogged()) {
            header('Location: /'); exit;
        }

        $this->view->appendToLayout('body', 'user.add-post');
        $this->view->display('layouts.default',
            array('is_logged' => $this->isLogged(), 'nav' => 'add-post'));

    }

    public function addPost() {
        if(!$this->isLogged()) {
            header('Location: /'); exit;
        }

        $title = $this->input->post('title');
        $content = \MDF\Common::xss_clean($this->input->post('content'));
        $session = $this->app->getSession();
        $uid = $session->uid;

        $postModel = new \Models\Posts();
        $lastInsertedId = $postModel->addPost($uid, $title, $content);

        if(\MDF\Validator::numeric($lastInsertedId)) {
            $result['success'] = 'Checkout your fresh post';
            $result['postId'] = $lastInsertedId;
        } else {
            $result['error'] = 'Post failed to save. Please try again.';
        }

        echo json_encode($result);
    }

    public function deletePost($args) {
        if(!$this->isLogged()) {
            header('Location: /'); exit;
        }

        if(\MDF\Validator::numeric($args[0])) {
            $postId = \MDF\Common::normalize($args[0], 'int');

            $postsModel = new \Models\Posts();
            $authorId = $this->app->getSession()->uid;
            try{
                $postsModel->changePostState($authorId, $postId, 'deleted');
                $result['success'] = 'Post deleted!';
            } catch(\Exception $ex) {
                $result['error'] = $ex->getMessage();
            }

        } else {
            $result['error'] = 'Unknown post!';
        }

        echo json_encode($result);
    }
}