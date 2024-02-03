<?php 
ob_start(); 
require_once(realpath(__DIR__ . '/dal/DAL.php'));

$product = null;
$id = null;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$dal = new DAL();
$product = $dal->ProductFact()->getProduct($id);
$nom = null;
$image = null;
$quantite = null;
$prix = null;
$unite = null;
?>

<?php
        $nom = $product->nom;
        $image = $product->image;
        $quantite = $product->quantite;
        $prix = $product->prix;
        $unite = $product->unite
 ?>

<div class="nom">
    <h2><?= $nom; ?></h2>
</div>

<div class="article">
    

    <div>
        <img  src=img/<?= $image; ?> alt="image de produit"><br><br>
    </div>
    

    <div class="details">
        <h1>Détails du produit</h1>
        <p><?= $quantite; ?><?= $unite; ?></p>
        <p><?= number_format($prix , 2); ?>$</p>

        <div class="form">
            <form  method="POST" action='cart-process.php?action=add&id=<?=$id ?>'>
                <label for="quantity">Quantité:</label>
                <input type="number" name="quantity" id="quantity" min="1" max="10" value="1"><br><br>
                <input class="standard-button" type="submit" value="Ajouter au panier">
            </form>
        </div>
        
    </div>

</div>


<?php 
    $content = ob_get_clean(); 
    require("includes/template.php");
?>