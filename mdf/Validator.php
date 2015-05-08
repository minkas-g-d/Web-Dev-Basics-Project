<?php

namespace MDF;


class Validator {
    private $_rules = array();
    private $_errors = array();

    public function setRule($rule, $value, $params = null, $errorName = null) {
        $this->_rules[] = array('rule' => $rule, 'val' => $value, 'params' => $params, 'errorName' => $errorName);
        return $this;
    }

    public function validate() {
        $this->_errors = array();

        if(count($this->_rules) > 0) {
            foreach($this->_rules as $rule) {
                if(!$rule['rule']($rule['val'], $rule['params'])) {
                    if($rule['errorName']) {
                        $this->_errors[] = $rule['errorName'];
                    } else {
                        $this->_errors[] = $rule['rule'];
                    }
                }
            }
        }

        return (bool) !count($this->_rules);
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function __call($a, $b) {
        throw new \Exception('Unknown validation function.');
    }

    public static function required($val) {
        if (is_array($val)) {
            return !empty($val);
        } else {
            return $val != '';
        }
    }

    public static function matches($value1, $value2) {
        return $value1 == $value2;
    }

    public static function minlength($value, $minlegth) {
        return (mb_strlen($value) >= $minlegth);
    }

    public static function maxlength($val1, $val2) {
        return (mb_strlen($val1) <= $val2);
    }

    public static function alphanumdash($val1) {
        return (bool) preg_match('/^([-a-z0-9_-])+$/i', $val1);
    }

    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}