<?php


namespace simpleengine\models;

use simpleengine\core\Application;

class User implements DbModelInterface
{
    private $id;
    private $userName;
    private $email;

    public function __construct(number $id = null){
        parent::__construct();
        $this->find($id);
    }


    /**
     * find
     * @param number $id 
     */
    public function find(number $id)
    {
        $sql = "SELECT * FROM users WHERE id = ".(int)$id;
        $result = $this->db()->getRowResult($sql);

        if(isset($result)){
            $this->id = $result["id_user"];
            $this->userName = $result["user_name"];
            $this->email = $result["user_email"];
        }
    }




    /**
     * getUsersBasket
     * @return array 
     */
    public function getUsersBasket() : array
    {
        $basket = new Basket($this->id);
        return $basket->getProductsArray();
    }



    /**
     * getName
     * @return string userName
     */
    public function getName()
    {
        return $this->userName;
    }


    /**
     * getEmail
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }



    public function save()
    {
    }

    public function delete() 
    {
    }
}