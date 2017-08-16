<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

class Good extends CommonModel implements DbModelInterface
{

    public function __construct()
    {
        parent::__construct();
    }



    public function find(int $idGood) : array
    {
        $sql = "SELECT `id_good` as id,
                    `good_name` as name,
                    `good_price` as price,
                    `good_type` as type,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `id_good` = $idGood
                    AND `is_active` = 1";
        return $this->db->getRowResult($sql);
    }

    

    public function findFour() : array
    {
        $sql = "SELECT `id_good` as id, 
                    `good_name` as name,
                    `good_price` as price,
                    `good_type` as type,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `is_active` = 1
                    LIMIT 4";
        return $this->db->getAssocResult($sql);
        
    }


    
    public function findAll() : array
    {
        $sql = "SELECT `id_good` as id, 
                    `good_name` as name,
                    `good_price` as price,
                    `good_type` as type,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `is_active` = 1";
        return $this->db->getAssocResult($sql);
        
    }



    public function save() {}


    public function delete() {}
}