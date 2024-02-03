<?php 
ob_start(); 
require_once(realpath(__DIR__ . '/dal/DAL.php'));

$CartProducts = null;
$id = null;
$idCart = null;
$produitId = null;
$quantite = null;
$unite = null;
$token = null;

$products = null;
$nom = null;
$image = null;
$prix = null;

$coutTotal = 0;


if(isset($_COOKIE["token"])){
    $token = $_COOKIE["token"];
    $dal = new DAL();
    $CartProducts = $dal->CartProductFact()->GetCartProduct($token);

    foreach($CartProducts as $cart){
        $produitId = $cart->produitId;
    
        //Je regroupe tous les produits de ce panier pour l'affichage
        $products[] = [$dal->ProductFact()->getProduct($produitId), $cart->quantite, $cart->id];
    }
}
?>

<div class="nom">
    <h2>Votre panier d'achat</h2><br><br>
</div>

    <div class="panier">

    <?php 
    if(!isset($_COOKIE["token"]) || $CartProducts == null){
        echo "<div class=\"nom\">
                <h2>Aucun produit dans le panier !</h2><br><br>
              </div>";
    }
    else{
             foreach($products as $p){
                $nom = $p[0]->nom;
                $image = $p[0]->image;
                $id = $p[0]->id;
                $quantite = $p[1];
                $unite = $p[0]->unite;
                $quantitePanier = $p[1] * $p[0]->quantite;
                $prixPanier = $p[0]->prix * $p[1];
    
                $idCart = $p[2];
        ?>
            
        <div class="item">
            <img  src=img/<?= $image; ?> alt="image de produit">
            <div class="quantite"><?= $quantite; ?> x <?= $nom; ?></div>
            <div class="item-detail"><?= $quantitePanier; ?> <?= $unite; ?></div> 
            <div class="item-detail"><?= number_format($prixPanier , 2); ?> $</div>
            <div class="item-detail">
                <a href='cart-process.php?action=remove&id=<?= $idCart ?>'>
                <i class="fa-solid fa-trash"></i>
            </a>
            </div>
                
        </div>
    <?php   
    $coutTotal += $prixPanier;
        }
        ?>
    <?php
    }
    ?>
        <div class="cout-total">
            <p>Coût total: <?= number_format($coutTotal, 2); ?>$</p>
        </div>

        <a class="standard-button" href=index.php>Continuer votre magasinage</a><br>
        
    </div>

<?php 
    $content = ob_get_clean(); 
    require("includes/template.php");
?>