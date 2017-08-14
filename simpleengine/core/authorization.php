<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class Authorization 
{

    const SALT = "awOIHO@EN@Oine/q2enq2kbkb";

    public static function checkAuthWithCookie() : bool
    {
        $result = false;

        if (isset($_COOKIE['cookie_hash'])) {
            $app = Application::instance();
            $db = $app->db();
            $secure = $app->secure();
            $userId = getSecureQuery($_COOKIE['id_user'], 11);
            $sql = "SELECT `user_name`, `user_password`, `user_email` FROM `user` WHERE `id_user` = " . $userId;
            $userData = $db->getRowResult($sql);
            $passwordHash = hashPassword($userData['user_password']);
            if ($passwordHash == urldecode($_COOKIE['cookie_hash'])) {
                $result = true;
                $_SESSION['user'] = $user_data;
            }
        }
        return $result;
    }



    public static function alreadyLoggedIn() : bool
    {
        return isset($_SESSION['user']);
    }


 
    public static function isMaster(): bool
    {
        return isset($_SESSION['status']) ?
        $_SESSION['status'] == 'full_controll' :
        false;
    } 


    public function hashPassword(string $password) : string
    {
    $salt = md5(uniqid(self::SALT, true));
    $saltStrong = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    return crypt($password, '$2a$08$' . $saltStrong);
    }



    public function checkPassword(string $password, string $hash) : bool
    {   
        return crypt($password, $hash) === $hash;
    }




}