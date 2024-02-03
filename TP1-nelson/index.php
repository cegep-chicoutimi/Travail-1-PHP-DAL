<?php 
ob_start(); 
require_once(realpath(__DIR__ . '/dal/DAL.php'));

$products = null;

$image = null;
$nom = null;
$id = null;


$dal = new DAL();
$products = $dal->ProductFact()->getAllProducts();
?>

<div class="nom">
    <h2>Nos produits disponibles</h2>
</div>


<div class="product-list">

    <?php
    if($products == null){
      echo "La liste des produits n'a pas pu etre récupérée depuis la BD";
    }
    else{
      foreach($products as $p){
        $nom = $p->nom;
        $image = $p->image;
        $id = $p->id;
        ?>
        
        <div class="product-item">
          <div class="product-image">
          <img  src="img/<?= $image; ?>" alt="image de produit ">
        </div>
        <div class="product-name"><?= $nom;?></div>
        <a href="product-view.php?id=<?= $id ?>" class="standard-button ">Voir l'article</a>
        </div>

        <?php
      }
    }
     ?>
</div>

<?php 
    $content = ob_get_clean(); 
    require("includes/template.php");
?>