<!DOCTYPE html>
<html lang="fr">
    <head>
      <meta charset="utf-8"/>  
      <title>Mon épicerie en ligne</title>
      <link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <link href="css/site.css" rel="stylesheet"/>
    </head>

    <body>
        <div class="container">
            <header>
                <h1>Mon épicerie en ligne</h1>
                <div class="menu">
                <i class="fa-sharp fa-solid fa-house"></i><a href="index.php">Accueil</a>  |  <i class="fa-solid fa-cart-shopping"></i><a href="cart-view.php">Mon panier</a>
                </div>
            </header>

            <main>
                <?= $content ?>
            </main>

            <footer>
                <p class="nelson">[Nelson Junior YN]</p>
                <p>Tous droits réservés © cchic.ca</p>
            </footer>
        </div>
    </body>
</html>
