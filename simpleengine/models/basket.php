<?php

namespace simpleengine\models;

use simpleengine\core\Application;


class Basket extends CommonModel implements DbModelInterface
{
    private $productsArray = [];
    protected $idUser;
    private $commonParams = [
        "count" => 0,
        "amount" => 0
    ];
    

    
    public function __construct(int $idUser)
    {
        parent::__construct();
        $this->idUser = $idUser;
        $this->find($idUser);
        $this->prepareBasketBlock($idUser);
    }



    
    public function find(int $idUser)
    {
        $sql = "SELECT b.*, g.good_name, g.good_price, g.good_type
                FROM `basket` b
                LEFT JOIN `goods` g USING(`id_good`)
                WHERE b.id_user = $idUser";
        $result = $this->db->getAssocResult($sql);

        if (!empty($result)) {
            foreach ($result as $item) {
                $this->productsArray[] = [
                    "id" => $item["id_good"],
                    "price" => $item["good_price"],
                    "name" => $item["good_name"],
                    "type" => $item["good_type"]
                ];
            }
        }
    }



    
    public function delete() : bool
    {
        $sql = "DELETE FROM `basket` WHERE `id_user` = $this->idUser";
        return $this->db->executeQuery($sql);
    }


    public function save() {}




        
    public function prepareBasketBlock(int $idUser)
    {
        $sql = "SELECT COUNT(`id_basket`) AS `goods`, SUM(`price`) as `amount`
                                        FROM `basket`
                                        WHERE `id_user` = $idUser";

        $basketData = $this->db->getRowResult($sql);

        $goodsCount = $basketData['goods'];
        $amount = $basketData['amount'];

        if ($goodsCount > 0) {
           $this->commonParams['count'] = $goodsCount;
           $this->commonParams['amount'] = $amount;
           $_SESSION['amount'] = $amount;
        } 
        else {
        $_SESSION['amount'] = 0;
        }
    }


    
    public function getProductsArray() : array
    {
        return $this->productsArray;
    }



 
    
    public function getCommonParams() : array
    {
        return $this->commonParams;
    }




    
    public function doAction(string $action)
    {
        switch($action) {
            case "add_good":
                $this->addGoodToBasket();
                break;
            case "remove_good":
                $this->removeGoodFromBasket();
                break;
            case "remove_all":
                $this->delete();
                break;
            default:
                break;
        }
    }




    private function addGoodToBasket()
    {
        $idGood = (int)$this->secure->getSecureQuery($_POST['id_good'], 120);
        $quantity = $this->secure->getSecureQuery($_POST['quantity'], 11);

        $sql = "SELECT `good_price` FROM `goods` WHERE `id_good` = $idGood";
        $priceData = $this->db->getRowResult($sql);
        $price = $priceData['good_price'];
        if($quantity > 0 && $priceData['good_price'] > 0) {
            for($i = 0; $i < $quantity; $i++) {
                $sql = "INSERT INTO `basket` (`id_user`, `id_good`, `price`) 
                VALUES($this->idUser, $idGood, $price)";
                $this->db->executeQuery($sql);
            }
        }
    }



    private function removeGoodFromBasket()
    {
        $idGood = $this->secure->getSecureQuery($_POST['id_good'], 120);
        $quantity = $this->secure->getSecureQuery($_POST['quantity'], 11);

        $sql = "SELECT `good_price` FROM `goods` WHERE `id_good` = $idGood";
        $priceData = $this->db->getRowResult($sql);

        if($quantity > 0 && $priceData['good_price'] > 0) {
            for($i = 0; $i < $quantity; $i++){
                $sql = "DELETE FROM `basket` WHERE `id_good` = $idGood 
                        AND `id_user` = $this->idUser LIMIT 1";
                $this->db->executeQuery($sql);
            }
        }
    }
}
