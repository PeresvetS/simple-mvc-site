<?php


namespace simpleengine\models;

use simpleengine\core\Application;

class User extends CommonModel implements DbModelInterface
{
    private $id;
    private $userName;
    private $email;

    public function __construct(int $id = null) {
        parent::__construct();
        $this->id = $id;
        $this->find($id);
    }



    public function find(int $id)
    {
        $sql = "SELECT * FROM user WHERE id_user = ".(int)$id;
        $result = $this->db->getRowResult($sql);

        if(isset($result)){
            $this->userName = $result["user_name"];
            $this->email = $result["user_email"];
        }
    }



    
    public function getUsersBasket() : array
    {
        $basket = new Basket($this->id);
        return $basket->getProductsArray();
    }


    public function doAction(string $action = "") : string
    {
        switch ($action) {
            case "update_password":
                return $this->updatePassword();
            case "update_email":
                return $this->updateEmail();
            default:
                return '';
                break;
        }
    } 

    public function updatePassword() : string
    {
        $password = $this->secure->getSecureQuery($_POST['pass1'], 100);
        $hashPassword = $this->app->auth()->hashPassword($password);

        $sql = "UPDATE `user` SET `user_password` = '$hashPassword'  WHERE `id_user` = $this->id";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return 'pass-success';
        }
        return 'pass-error';
    }



    public function updateEmail() : string
    {
        $email = $this->secure->getSecureQuery($_POST['email'], 50);
        $sql = "UPDATE `user` SET `user_email` = '$email' WHERE `id_user` = $this->id";

        $result = $this->db->executeQuery($sql);
        if ($result) {
           return 'email-success';
        }
        return 'email-error';
    }



    public function getName() : string
    {
        return $this->userName;
    }



    
    public function getEmail() : string
    {
        return $this->email;
    }


    public function save() {}

    public function delete() {}
}