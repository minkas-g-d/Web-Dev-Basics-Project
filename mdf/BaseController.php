<?php

namespace MDF;


class BaseController {
    /**
     *
     * @var \MDF\App
     */
    public $app;
    /**
     *
     * @var \MDF\View
     */
    public $view;
    /**
     *
     * @var \MDF\Config
     */
    public $config;
    /**
     *
     * @var \MDF\InputData
     */
    public $input;

    public function __construct() {
        $this->app = \MDF\App::getInstance();
        $this->view = \MDF\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = \MDF\InputData::getInstance();
    }

    public function __call($a, $b) {
        $this->index();
    }

    public function isLogged() {
        $session = $this->app->getSession();
        if($session->is_logged == null) {
            return false;
        }
        return true;
    }
}