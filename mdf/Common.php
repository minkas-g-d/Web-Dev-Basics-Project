<?php

namespace MDF;


class Common {
    public static function normalize($data, $types) {
        $types = explode('|', $types);
        var_dump($types);
        if(is_array($types)) {
            foreach($types as $type) {
                if($type == 'int') {
                    $data = (int)$data;
                }
                if($type == 'float') {
                    $data = (float) $data;
                }
                if($type == 'double') {
                    $data = (double) $data;
                }
                if($type == 'bool') {
                    $data = (bool) $data;
                }
                if($type == 'string') {
                    $data = (string) $data;
                }
                if($type == 'trim') {
                    $data = trim($data);
                }
                if($type == 'xss') {
                    //TODO include check for xss
                }
            }
        }

        return $data;
    }
}