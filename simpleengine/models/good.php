<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

class Good extends CommonModel implements DbModelInterface
{

    public function __construct()
    {
        parent::__construct();
    }



    public function find($idGood) : array
    {
        $sql = "SELECT `good_name` as name,
                    `good_price` as price,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `id_good` = $idGood
                    AND `is_active` = 1";
        return $this->db->getRowResult($sql);
    }


    
    public function findAll() : array
    {
        $sql = "SELECT `good_name` as name,
                    `good_price` as price,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `is_active` = 1";
        return $this->db->getAssocResult($sql);
        
    }



    public function save() {}


    public function delete() {}
}