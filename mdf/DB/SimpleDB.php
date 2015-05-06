<?php

namespace MDF\DB;


class SimpleDB {
    // provide a property that can be overridden by child classes
    protected $connection = 'default';
    private $db = null;
    private $slq = null;
    private $stmt = null;
    private $params = array();

    public function __construct($connection = null) {
        // We might pass an PDO object
        if($connection instanceof \PDO) {
            $this->db = $connection;
        } else if($connection != null) {
            $this->db = \MDF\App::getInstance()->getDBConnection($connection);
            $this->connection = $connection;
        } else {
            $this->db = \MDF\App::getInstance()->getDBConnection($this->connection);
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @param array $pdoOptions
     * @return \MDF\DB\SimpleDB
     */
    public function prepare($sql, $params = array(), $pdoOptions = array()) {
        $this->stmt = $this->db->prepare($sql, $pdoOptions);
        $this->slq = $sql;
        $this->params = $params;

        return $this;
    }

    /**
     * @param array $params
     * @return \MDF\DB\SimpleDB
     */
    public function execute($params = array()){

        if($params) {
            $this->params = $params;
        }
        $this->stmt->execute($this->params);

        return $this;
    }

    public function fetchAllAssoc() {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc() {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllNum() {
        return $this->stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public function fetchRowNum() {
        return $this->stmt->fetch(\PDO::FETCH_NUM);
    }

    public function fetchAllObj() {
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchRowObj() {
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchAllCol($column) {
        return $this->smtm->fetchAll(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchRowCol($column) {
        return $this->smtm->fetch(\PDO::FETCH_BOUND, $column);
    }

    public function getLastInsertedId() {
        return $this->db->lastInsertId();
    }

    public function getAffectedRows() {
        return $this->stmt->rowCount();
    }

    public function getSTMT() {
        return $this->stmt;
    }
}