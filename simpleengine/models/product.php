<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

class Product implements DbModelInterface
{


    /**
     * __construct
     * @param number $goodNumber 
     */
    public function __construct(number $idGood)
    {
        if(is_numeric($idGood) && $idGood > 0) {
            $this->idGood = $idGood;
            $this->db = Application::instance()->db();
            
        } else {
            location("/");
        }
    }


    /**
     * find
     * @return array 
     */
    public function find() : array
    {
        $sql = "SELECT `good_name` as name,
                    `good_price` as price,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `id_good` = $this->idGood
                    AND `is_active` = 1";
        return $this->db()->getRowResult($sql);
    }



    public function save()
    {
        // TODO: Implement save() method.
    }


    public function deactivate() 
    {
        //
    }
}