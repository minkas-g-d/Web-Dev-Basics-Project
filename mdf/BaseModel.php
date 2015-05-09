<?php

namespace MDF;

class BaseModel {

    /**
     * @var DB\SimpleDB
     */
    public $db;

    public function __construct() {
        $this->db = new \MDF\DB\SimpleDB('default');
    }

}