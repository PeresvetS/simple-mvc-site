<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

class Good implements DbModelInterface
{


    /**
     * __construct
     * @param number $idUser 
     */
    public function __construct(number $idUser)
    {
        $this->db = Application::instance()->db();
        $this->find($idUser);
    }



    /**
     * find
     * @param number $idUser 
     * @return array 
     */
    public function find($idUser) : array
    {
        $sql = "SELECT `good_name` as name,
                    `good_price` as price,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`
                    WHERE `is_active` = 1";
        return $this->db()->getAssocResult($sql);
        
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