<?php

class Authorize {

    static public function is_logged() {

        if(isset($_SESSION['user']))
            return 1;

        return 0;

    }

    static public function logout() {
        unset($_SESSION['user']);
    }

    static public function check($login, $password) {

        if($login == 'admin' && $password == '123') { // 123
            self::setSession($login);
            return 1;
        }

        return 0;

    }

    static private function setSession($login) {
        $_SESSION['user'] = $login;
    }

}