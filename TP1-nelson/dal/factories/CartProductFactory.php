<?php
require_once(realpath(__DIR__ .'/base/FactoryBase.php'));
require_once(realpath(__DIR__ .'/../models/CartProduct.php'));

class CartProductFactory extends FactoryBase
{
    public function GetCartProduct($token){ //On essaie d'abord de regrouper tous les produits d'un meme panier

        $cartProducts = array();
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT * FROM h24_web_transac_2130331.tp1_panier 	WHERE Token = ?');
        $stmt->execute([$token]);
        
        while($row = $stmt->fetch()){
            $cartProducts[] = new CartProduct($row);
        }
        $stmt->closeCursor();

        return $cartProducts;
    }

    public function  AddProduct($produitId, $quantite, $token){
       
        $db = $this->dbConnect();
       
        //On vérifie d'abord si le produit est déja présent dans le panier du visiteur
        $stmt = $db->prepare('SELECT * FROM h24_web_transac_2130331.tp1_panier WHERE produitId = ? AND Token = ?');
        $stmt->execute([$produitId, $token]);

        $row = $stmt->fetch();
        
        if($row == false){ //Si le produit n'est pas dans le panier, on l'insère
            $stmt = $db->prepare('INSERT INTO h24_web_transac_2130331.tp1_panier (produitId, Quantite, Token) VALUES (?, ?, ?)');
            $stmt ->execute([$produitId, $quantite, $token]);
        }
        else{
            $stmt = $db->prepare('UPDATE h24_web_transac_2130331.tp1_panier SET Quantite = Quantite + ? WHERE produitId = ? AND Token = ?');
            $stmt ->execute([$quantite, $produitId, $token]);
        }

       
        
    }

    public function DeleteProduct($id){
        $db = $this->dbConnect();
        $stmt = $db->prepare('DELETE FROM h24_web_transac_2130331.tp1_panier WHERE Id = ?');
        $stmt ->execute([$id]);
        $stmt->closeCursor();
    }
}

 ?>