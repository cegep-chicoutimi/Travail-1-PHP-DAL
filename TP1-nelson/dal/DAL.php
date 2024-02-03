<?php
require_once(realpath(__DIR__ .'/factories/CartProductFactory.php'));
require_once(realpath(__DIR__ .'/factories/ProductFactory.php'));


class DAL   //La couche d'accès aux données
{
    private $productFact = null;    //le prototype
    private $cartProductFact = null;

    public function ProductFact()
    {
        if($this->productFact == null){
            $this->productFact = new ProductFactory();
        }

        return $this->productFact;
    }

    public function CartProductFact()
    {
        if($this->cartProductFact == null){
            $this->cartProductFact = new CartProductFactory();
        }

        return $this->cartProductFact;
    }
}
 ?>