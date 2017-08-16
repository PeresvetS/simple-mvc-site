<?php
namespace simpleengine\models;

use \simpleengine\core\Application;

class AuthModel extends CommonModel
{

    public function __construct()
    {
        parent::__construct();
    }


    public function auth() : bool
    {
        $isAuth = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $auth = $this->app->auth();
            $username = $this->secure->getSecureQuery($_POST['login'], 50);
            $password = $this->secure->getSecureQuery($_POST['password'], 100);
        

            $sql = "SELECT `id_user`, `user_name`, `user_password`, `user_email` FROM `user` WHERE `user_login` = '$username'";
            $userData = $this->db->getRowResult($sql);
            var_dump($userData);

            if ($userData) {
                if($auth->checkPassword($password, $userData['user_password'])) {
                    $isAuth = true;
                    if ($username == 'master') {
                        $_SESSION['status'] = 'full_controll';
                    }
                    if(isset($_POST['remember']) && $_POST['remember'] == 'on'){
                        setcookie("cookie_hash", $userData['user_password'], time()+86400);
                    }
                    $_SESSION['user'] = $userData;
                }
            }
        } 
        return $isAuth;
    }



    public function register() : bool
    {   
        $secure = $this->secure;
        $userName = $secure->getSecureQuery($_POST["user_name"], 60);
        if ($userName == "master") {
             header("Location: /");
        }
        $email = $secure->getSecureQuery($_POST["email"], 40);
        $login = $secure->getSecureQuery($_POST["login"], 50);
        $passwordRaw = $secure->getSecureQuery($_POST["password"], 100);
        $password = $this->app->auth()->hashPassword($passwordRaw);

        $time = date("d.m.Y H:i:s");
        $sql = "INSERT INTO `user` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`, `user_email`)
                VALUES (NULL, '$userName', '$login', '$password', '$time', '$email')";
        return $this->db->executeQuery($sql);
    }

}