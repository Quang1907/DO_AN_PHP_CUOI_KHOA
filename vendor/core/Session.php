<?php

namespace Core;

class Session
{
    static public function data($field = "", $value = "")
    {
        $sessionKey = self::isInvalid();
        if (!empty($field)) {
            if (!empty($value)) {
                return $_SESSION[$sessionKey][$field] = $value; //set session
            } else {
                if (!empty($_SESSION[$sessionKey][$field])) {
                    $getSession = $_SESSION[$sessionKey][$field];
                    return $getSession; // get one session
                }
            }
            return;
        }
        $allSession = empty($_SESSION[$sessionKey]) ? false : $_SESSION[$sessionKey];
        return $allSession; // return all session
    }

    static public function flash($field = "", $value = "")
    {
        $flash = self::data($field, $value);
        if (empty($value)) {
            self::delete($field);
        }
        return $flash;
    }

    static public function delete($field = "")
    {
        $sessionKey = self::isInvalid();
        if (!empty($field)) {
            if (!empty($_SESSION[$sessionKey][$field])) {
                unset($_SESSION[$sessionKey][$field]); // xoa 1 session
                return;
            }
            return;
        }
        unset($_SESSION[$sessionKey]); // xoa toan bo session
        return;
    }

    static public function isInvalid()
    {
        global $config;
        if (!empty($config['session'])) {
            $session = $config['session'];
            if (!empty($session['session_key'])) {
                $sessionKey = $session['session_key'];
                return $sessionKey;
            } else {
                Error::render(["error" => "Thieu cau hinh session key. Vui long kiem tra tai configs/session.php"], "Session");
                die();
            }
        } else {
            Error::render(["error" => "Thieu cau hinh session. Vui long kiem tra tai configs/session.php"], "Session");
            die();
        }
    }
}
