<?php

namespace MDF\Session;


class NativeSession implements \MDF\Session\ISession {

    public function __construct($name, $lifetime = 3600, $path = null, $domain = null, $secure = false) {

        if(strlen($name) < 1) {
            $name = '__sess';
        }

        session_name($name);
        // prevent session hijacking with setting the 5th param($httponly) to true
        // prevent js access the session cookie
        session_set_cookie_params($lifetime, $path, $domain, $secure, true);
        session_start();
    }

    public function __get($name)
    {
        return $_SESSION[$name];
    }

    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function getSessionId()
    {
        return session_id();
    }

    public function saveSession()
    {
        session_write_close();
    }

    public function destroySession() {
        session_destroy();
    }
}