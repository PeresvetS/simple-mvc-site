<?php

namespace simpleengine\models;

use simpleengine\core\Application;

class Basket extends CommonModel implements DbModelInterface
{
    private $productsArray = [];
    private $idUser;
    /**
     * __construct
     * @param number $id_user 
     */
    public function __construct(number $idUser)
    {
        parent::__construct();
        $this->$idUser = $idUser;
        $this->find($this->id_user);
    }


    /**
     * find
     * @param mixed $id_user 
     * @return array 
     */
    public function find(number $id_user)
    {
        $app = Application::instance();
        $sql = "SELECT b.*, p.product_name
                FROM basket b
                LEFT JOIN products p ON p.id = b.id_product
                WHERE b.id_user = ".(int)$id_user."
                AND b.id_order IS NULL";
        $result = $app->db()->getAssocResult($sql);

        if(!empty($result)){
            foreach($result as $item){
                $this->productsArray[] = [
                    "id_basket" => $item["id"],
                    "id_product" => $item["id_product"],
                    "product_price" => $item["product_price"],
                    "product_name" => $item["product_name"]
                ];
            }
        }
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function getProductsArray() : array
    {
        return $this->productsArray;
    }

    /**
     * delete
     * @return bool 
     */
    public function delete() : bool
    {
        $sql = "DELETE FROM basket WHERE id_user = $this->$idUser";
        return $this->db()->executeQuery($sql);
    }
}