<?php

namespace Models;


class User extends \MDF\BaseModel {

    public function addUser($uname, $upass, $email, $fname='', $lname='') {

        if($this->checkUserExists($uname)[0] == 1) {
            throw new \Exception('Username not available!');
        }
        $hashedPass = \MDF\Common::hashPass($upass);

        $result = $this->db->prepare('INSERT INTO mdf_users (username, pass_hash, firstname, lastname, email, registered)
          VALUES (?, ?, ?, ?, ?, ?)',
            array($uname, $hashedPass, $fname, $lname, $email, date('Y-m-d H:i:s')))
            ->execute()
            ->getLastInsertedId();

        return $result;

    }

    public function checkUserExists($uname) {
        $result = $this->db->prepare('SELECT * FROM mdf_users WHERE username=?', array($uname))
            ->execute()->fetchRowNum();

        if($result != false && $result[0] > 1) {
            throw new \Exception('There is more than one user with username '.$uname.'.');
        }

        return $result;
    }

    public function getUserByName($uname) {
        $result = $this->db->prepare('SELECT id, username, pass_hash, firstname, lastname, email
            FROM mdf_users
            WHERE username=?', array($uname))->execute()->fetchRowAssoc();

        return $result;
    }
}