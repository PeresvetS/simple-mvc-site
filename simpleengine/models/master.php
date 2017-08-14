<?php


namespace simpleengine\models;

use \simpleengine\core\Application;


class Master extends CommonModel
{

    public function __construct()
    {
        parent::__construct();
    }



    public function doAction(string $action = "") : bool
    {
        switch ($action) {
            case "create_good":
                return $this->createGood();
            case "update_good":
                return $this->updateGood();
            case "delete_good":
                return $this->deleteGood();
            default:
                break;
        }
    } 



    public function createGood() : bool
    {
        $secure = $this->secure;
        $goodName = $secure->getSecureQuery($_POST["good_name"], 100);
        $goodPrice = $secure->getSecureQuery($_POST["good_price"], 20);
        $goodType = $secure->getSecureQuery($_POST["good_type"], 20);
        $goodDescription = $secure->getSecureQuery($_POST["good_description"], 9999);
        $goodImg = $secure->getSecureQuery($_POST["good_img"], 100);
        $isActiveRaw = $_POST["is_active"];
        $isActive = $isActiveRaw == "true" ? 1 : 0;

        $sql = "INSERT INTO `goods` (`id_good`, `good_name`, `good_price`, `good_type`,
                                    `good_description`, `good_img`, `is_active`)
                VALUES(NULL, '$goodName', '$goodPrice', '$goodType',
                        '$goodDescription', '$goodImg', $isActive)";

        return $this->db->executeQuery($sql);
    }




    public function updateGood() : bool
    {
        $secure = $this->secure;
        $idGood = (int)$secure->getSecureQuery($_POST["id_good"], 11);
        $updateImg = $this->updateImg($idGood);

        if ($updateImg) {
            $goodName = $secure->getSecureQuery($_POST["good_name"], 100);
            $goodPrice = $secure->getSecureQuery($_POST["good_price"], 20);
            $goodType = $secure->getSecureQuery($_POST["good_type"], 20);
            $goodDescription = $secure->getSecureQuery($_POST["good_description"], 9999);
            $isActiveRaw = $_POST["is_active"];
            $isActive = $isActiveRaw == "true" ? 1 : 0;

            $sql = "UPDATE `goods` SET `good_name` = '$goodName', `good_price` = '$goodPrice'
                `good_type` = '$goodType', `good_description` = '$goodDescription', 
                `is_active` = $isActive
                WHERE `id_good` = $idGood";

            return $this->db->executeQuery($sql);
        }
        return false;
    }

    

    
    public function updateImg(number $idGood)
    {
        $file = $this->app->file();
        $imgPath = $this->getGoodImg($idGood);

        $deleteImg = $file->deleteFile($imgPath);
        if(!$deleteImg) {
            return false;
        }

        $goodImgPath = $file->uploadFile();
        if ($goodImgPath) {
            $sql = "UPDATE `goods` SET `good_img` = '$goodImgPath' WHERE `id_good` = $idGood";
            return $this->db->executeQuery($sql);
        }
        return false;
    }



    
    public function deleteGood() : bool
    {
        $file = $this->app->file();
        $idGood = (int)$this->secure->getSecureQuery($_POST["id_good"], 11);
        $imgPath = $this->getProductImg($idProduct);
        $deleteImg = $file->deleteFile($imgPath);

        if ($deleteImg) {
            $sql = "DELETE FROM `goods` WHERE `id_good` = $idProduct LIMIT 1";
            return $this->db->executeQuery($sql);
        }
        return false;
    }




    private function getGoodImg(int $idGood) : string
    {
        $sql = "SELECT `good_img` FROM `goods` WHERE `id_good` = $idGood";
        $imgLink = $this->db->getRowResult($sql);
        return $imgLink;
    }


}