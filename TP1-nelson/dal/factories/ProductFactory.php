<?php
require_once(realpath(__DIR__ .'/base/FactoryBase.php'));
require_once(realpath(__DIR__ .'/../models/Product.php'));

class ProductFactory extends FactoryBase
{
    public  function getAllProducts()
    {
        $products = array();

        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT * FROM h24_web_transac_2130331.tp1_produits ORDER BY Nom');
        $stmt->execute();

        while($row = $stmt->fetch()){
            $products[] = new Product($row);
        }

        $stmt->closeCursor();

        return $products;
    }

    public function getProduct($id){
        $product = null;
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT * FROM h24_web_transac_2130331.tp1_produits 	WHERE 	Id = ?');
        $stmt ->execute([$id]);

        if($row = $stmt->fetch()){
            $product = new Product($row);
        }
        $stmt->closeCursor();

        return $product;
    }
}

 ?>