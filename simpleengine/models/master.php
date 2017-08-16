<?php


namespace simpleengine\models;

use \simpleengine\core\Application;


class Master extends CommonModel
{
    public function __construct()
    {
        parent::__construct();
    }


    public function findAllGoods() 
    {
        $sql = "SELECT `id_good` as id, 
                    `good_name` as name,
                    `good_price` as price,
                    `good_type` as type,
                    `good_description` as description,
                    `good_img` as img
                    FROM `goods`";
        return $this->db->getAssocResult($sql);
    }


    public function doAction(string $action = "") : bool
    {
        switch ($action) {
            case "create_good":
                return $this->createGood();
            case "update_good":
                return $this->updateGood();
            case "remove_good":
                return $this->removeGood();
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
        $isActiveRaw = $_POST["is_active"];
        $isActive = $isActiveRaw == "active" ? 1 : 0;
        $goodImg = $this->uploadImg();


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
        $this->updateImg($idGood);

        $goodName = $secure->getSecureQuery($_POST["good_name"], 100);
        $nameExp = $goodName == '' ? '' : "`good_name` = '$goodName',";

        $goodPrice = $secure->getSecureQuery($_POST["good_price"], 20);
        $priceExp = $goodPrice == '' ? '' : "`good_price` = '$goodPrice',";
        
        $goodType = $secure->getSecureQuery($_POST["good_type"], 20);
        $typeExp = $goodType == '' ? '' : "`good_type` = '$goodType',";

        $goodDescription = $secure->getSecureQuery($_POST["good_description"], 9999);
        $descExp = $goodDescription == '' ? '' : "`good_description` = '$goodDescription',";

        $isActiveRaw = $_POST["is_active"];
        $isActive = $isActiveRaw == "active" ? 1 : 0;

        $sql = "UPDATE `goods` SET $nameExp $priceExp $typeExp $descExp
            `is_active` = $isActive
            WHERE `id_good` = $idGood";

        return $this->db->executeQuery($sql);
    }

    

    public function uploadImg() : string
    {
        $file = $this->app->file();
        $goodImgPath = $file->uploadFile();
        return $goodImgPath;
    }
    
    
    public function updateImg(int $idGood) : bool
    {
        $file = $this->app->file();

        $imgPath = $this->getGoodImg($idGood);
        if ($imgPath == '') {
            return false;
        }
        $goodImgPath = $file->uploadFile();
        if ($goodImgPath) {
            $file->deleteFile($imgPath);
            $sql = "UPDATE `goods` SET `good_img` = '$goodImgPath' WHERE `id_good` = $idGood";
            return $this->db->executeQuery($sql);
        }
        return false;
    }



    
    public function removeGood() : bool
    {
        $file = $this->app->file();
        $idGood = (int)$this->secure->getSecureQuery($_POST["id_good"], 11);
        $imgPath = $this->getGoodImg($idGood);
        $deleteImg = $file->deleteFile($imgPath);

        if ($deleteImg) {
            $sql = "DELETE FROM `goods` WHERE `id_good` = $idGood LIMIT 1";
            return $this->db->executeQuery($sql);
        }
        return false;
    }




    private function getGoodImg(int $idGood) : string
    {
        $sql = "SELECT `good_img` FROM `goods` WHERE `id_good` = $idGood";
        $result = $this->db->getRowResult($sql);
        return $result["good_img"];
    }


}