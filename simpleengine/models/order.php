<?php


namespace simpleengine\models;

use \simpleengine\core\Application;


class Order extends CommonModel implements DbModelInterface
{


    public function __construct(int $idUser)
    {
        parent::__construct($idUser);
        $this->$idUser = $idUser;
        $this->find($this->$idUser);
    }



    public function find(int $idUser)
    {
        $sql = "SELECT good_name, id_good, good_price FROM goods
        LEFT JOIN basket USING(id_good)
        WHERE id_user = $idUser";
        return $this->db->getAssocResult($sql);
    }



    public function save() : bool
    {
        $date =  (string)date("d.m.Y");
        $amount = $this->secure->getSecureQuery($_SESSION["amount"], 20);
        
        $sql = "INSERT INTO `order` (`id_order`, `id_user`, `amount`, `datetime_create`, `id_order_status`)
        VALUES (NULL, '$this->idUser', '$amount', '$date', 1)";
        return $this->db->executeQuery($sql);
    }


    public function delete() {}

}