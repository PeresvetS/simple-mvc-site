<?php
namespace simpleengine\models;

use \simpleengine\core\Application;

class AuthModel
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * authWithCredentials
     * @return bool 
     */
    public static function auth() : bool
    {
        $isAuth = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $auth = $this->app->auth();
            $username = $this->secure->getSecureQuery($_POST['login'], 50);
            $password = $this->secure->getSecureQuery($_POST['password'], 100);
        


            $sql = "SELECT id_user, user_name, user_password, user_email FROM user WHERE user_login = '$username'";
            $user_data = $this->db->getRowResult($sql);

            if ($user_data) {
                if($auth->checkPassword($password, $user_data['user_password'])) {
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
            } 
        return $isAuth;
    }


    /**
     * registerCredentials
     * @param string $password 
     * @return bool 
     */
    public static function register() : bool
    {   
        $secure = $this->secure;
        $userName = $secure->getSecureQuery($_POST["user_name"], 60);
        $email = $secure->getSecureQuery($_POST["email"], 40);
        $login = $secure->getSecureQuery($_POST["login"], 50);
        $pass = $secure->getSecureQuery($_POST["password"], 100);
        $time = date("d.m.Y H:i:s");
        $sql = "INSERT INTO `user` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`, `user_email`)
                VALUES (NULL, '$userName', '$login', '$pass', '$time', '$email')";
        return $db->executeQuery($sql);
    }

}