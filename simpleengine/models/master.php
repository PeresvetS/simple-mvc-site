<?php


namespace simpleengine\models;

use \simpleengine\core\Application;


class Master extends CommonModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find($id)
    {

    }



    /**
     * createGood
     * @param bool $isActiveRaw 
     * @return bool 
     */
    public function createGood(bool $isActiveRaw = true) : bool
    {
        $secure = $this->secure;
        $goodName = $secure->getSecureQuery($_POST["good_name"], 100);
        $goodPrice = $secure->getSecureQuery($_POST["good_price"], 20);
        $goodType = $secure->getSecureQuery($_POST["good_type"], 20);
        $goodDescription = $secure->getSecureQuery($_POST["good_description"], 9999);
        $goodImg = $secure->getSecureQuery($_POST["good_img"], 100);
        $isActive = $isActiveRaw ? 1 : 0;

        $sql = "INSERT INTO `goods` (`id_good`, `good_name`, `good_price`, `good_type`,
                                    `good_description`, `good_img`, `is_active`)
                VALUES(NULL, '$goodName', '$goodPrice', '$goodType',
                        '$goodDescription', '$goodImg', $isActive)";

        return executeQuery($sql);
    }




    /**
     * updateGood
     * @param number $idGoodRaw 
     * @param bool $isActiveRaw 
     * @return bool 
     */
    public function updateGood(number $idGoodRaw = NULL,  bool $isActiveRaw = true) : bool
    {
        $secure = $this->secure;
        $idGood = (int)$secure->getSecureQuery($idGoodRaw, 11);
        $goodName = $secure->getSecureQuery($_POST["good_name"], 100);
        $goodPrice = $secure->getSecureQuery($_POST["good_price"], 20);
        $goodType = $secure->getSecureQuery($_POST["good_type"], 20);
        $goodDescription = $secure->getSecureQuery($_POST["good_description"], 9999);
        $isActive = $isActiveRaw ? 1 : 0;


        $sql = "UPDATE `goods` SET `good_name` = '$goodName', `good_price` = '$goodPrice'
            `good_type` = '$goodType', `good_description` = '$goodDescription', 
            `is_active` = $isActive
            WHERE `id_good` = $idGood";

        return executeQuery($sql);
    }

    

    /**
     * updateImg
     * @param number $idGoodRaw
     * @return bool 
     */
    public function updateImg(number $idGoodRaw)
    {
        $file = $this->app->file;
        $imgPath = getProductImg($idProduct);
        $file->deleteFile($imgPath);
        $goodImgPath = $file->uploadFile();
        $sql = "UPDATE `goods` SET `good_img` = '$goodImgPath' WHERE `id_good` = $idGood";

        return executeQuery($sql);
    }


    /**
     * deleteGood
     * @param number $idGoodRaw 
     * @return bool 
     */
    public function deleteGood(number $idGoodRaw) : bool
    {
        $file = $this->app->file;
        $idGood = (int)$this->secure->getSecureQuery($idProductRaw);
        $imgPath = getProductImg($idProduct);
        $file->deleteFile($imgPath);
        $sql = "DELETE FROM `goods` WHERE `id_good` = $idProduct LIMIT 1";
        return $this->secure->executeQuery($sql);
    }




    /**
     * getGoodImg
     * @param number $idGoodRaw 
     * @return string 
     */
    private function getGoodImg(number $idGood) : string
    {
        $sql = "SELECT `good_img` FROM `goods` WHERE `id_good` = $idGood";
        $imgLink = $this->db->getRowResult($sql);
        return $imgLink;
    }


}