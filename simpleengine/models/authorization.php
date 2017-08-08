<?php
namespace simpleengine\models;

use \simpleengine\core\Application;

class AuthorizationModel
{
    /**
     * authWithCredentials
     * @return bool 
     */
    public function authWithCredentials() 
    {
        $app = Application::instance();
        $db = $app->db();
        if (isset($_POST['login'])) {
            $username = getSecureQuerySQL($_POST['login'], 50, $db);
        } else {
            $username = $_SESSION['user']['user_name'];
        }

        $password = getSecureQuerySQL($_POST['password'], 100, $db);


        $sql = "SELECT id_user, user_name, user_password, user_email FROM user WHERE user_login = '".$username."'";
        $user_data = getRowResult($sql, $db);

        $isAuth = false;


        if ($user_data) {
            if(checkPassword($password, $user_data['user_password'])) {
                $isAuth = true;
                if ($username == 'master') {
                $_SESSION['status'] = 'full_controll';
                }
                if(isset($_POST['rememberme']) && $_POST['rememberme'] == 'on'){
                    setcookie("cookie_hash", $user_data['user_password'], time()+86400);
                }
                $_SESSION['user'] = $user_data;
            }
        }
        return $isAuth;
    }



    /**
     * checkAuthWithCookie
     * @return bool 
     */
    public function checkAuthWithCookie()
    {
        $result = false;

        if (isset($_COOKIE['cookie_hash'])) {
            $link = getConnection();
            $userId = getSecureQuerySQL($_COOKIE['id_user'], 11);
            $sql = "SELECT `user_name`, `user_password`, `user_email` FROM `user` WHERE `id_user` = " . $userId;
            $user_data = getRowResult($sql, $link);
            $passwordHash = hashPassword($user_data['user_password']);
            if ($passwordHash == urldecode($_COOKIE['cookie_hash'])) {
                $result = true;
                $_SESSION['user'] = $user_data;
            }
        }
        return $result;
    }


    /**
     * alreadyLoggedIn
     * @return bool 
     */
    public function alreadyLoggedIn() : bool
    {
        return isset($_SESSION['user']);
    }



    /**
     * isMaster
     * @return bool 
     */
    public function isMaster(): bool
    {
        return $_SESSION['user']['status'] === 'master';
    } 

    /**
     * hashPassword
     * @param string $password 
     * @return string 
     */
    private function hashPassword($password)
    {
    $salt = md5(uniqid(SALT2, true));
    $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    return crypt($password, '$2a$08$' . $salt);
    }


    /**
     * checkPassword
     * @param $password
     * @param $hash
     * @return bool
     */
    private function checkPassword($password, $hash){
        return crypt($password, $hash) === $hash;
    }



    /**
     * registerCredentials
     * @param string $password 
     * @return bool 
     */
    public function registerCredentials(string $password)
    {
        $app = Application::instance();
        $db = $app->db();
        $userName = getSecureQuerySQL($_POST["user_name"], 60, $db);
        $email = getSecureQuerySQL($_POST["email"], 40, $db);
        $login = getSecureQuerySQL($_POST["login"], 50, $db);
        $pass = getSecureQuerySQL($password, 100, $db);
        $time = date("d.m.Y H:i:s");
        $sql = "INSERT INTO `user` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`, `user_email`)
    VALUES (NULL, '$userName', '$login', '$pass', '$time', '$email')";
        return executeQuery($sql, $db);
    }

}