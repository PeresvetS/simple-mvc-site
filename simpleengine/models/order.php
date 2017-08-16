<?php


namespace simpleengine\models;

use \simpleengine\core\Application;


class Order extends CommonModel implements DbModelInterface
{
    private $idUser;

    public function __construct(int $idUser)
    {
        parent::__construct();
        $this->idUser = $idUser;
    }



    public function find(int $idUser) : array
    {
        $sql = "SELECT o.id_order as id, o.amount as amount, o.datetime_create as date_c, s.order_status_name as status
                                  FROM `order` o
                                  LEFT JOIN `order_status` s USING(id_order_status)
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