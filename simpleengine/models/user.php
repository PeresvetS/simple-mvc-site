<?php


namespace simpleengine\models;

use simpleengine\core\Application;

class User implements DbModelInterface
{
    private $id;
    private $firstname;
    private $lastname;
    private $middlename;
    private $email;

    public function __construct($id = null){
        if((int)$id > 0){
            $this->find($id);
        }
    }

    public function auth(){

    }

    public function find($id)
    {
        $app = Application::instance();
        $sql = "SELECT * FROM users WHERE id = ".(int)$id;
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(isset($result[0])){
            $this->id = $result[0]["id_user"];
            $this->firstname = $result[0]["first_name"];
            $this->lastname = $result[0]["last_name"];
            $this->middlename = $result[0]["middle_name"];
            $this->email = $result[0]["email"];
        }
    }

    public function getUsersBasket(){
        $basket = new Basket($this->id);
        return $basket->getProductsArray();
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function deactivate() {
        //
    }

    /**
     * @return string firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string middlename
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }
}