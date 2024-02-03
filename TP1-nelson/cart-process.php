<?php 
require_once(realpath(__DIR__ . '/dal/DAL.php'));
//session_start();

$action = "";

if (isset($_GET["action"])) {
     switch($_GET["action"]) { 
        case "add": 
            if(!isset($_COOKIE['token'])){  //Si le cookie n'existe pas, il est généré automatiquement
                $token = generateToken();
                setcookie('token', $token); 
            }
            else{
                $token = $_COOKIE['token'];
            }

            AjoutAuPanier($token);
             break;
         case "remove": 
            if(isset($_GET["id"])){
                SupprimerDuPanier($_GET["id"]);
            }
             break; 
            }
         }


    header("Location: cart-view.php");
    exit();
                


//Suppression du panier
function SupprimerDuPanier($id){
    $dal = new DAL();
    $dal->CartProductFact()->DeleteProduct($id);
}


//Ajout au panier
function AjoutAuPanier($token){

    if(isset($_GET["id"]) && isset($_POST["quantity"])){
        $dal = new DAL();
        $dal->CartProductFact()->AddProduct($_GET["id"], $_POST["quantity"], $token);
    }
    
    
}

//Fonction qui permet de générer de façon aléatoire un token
function generateToken($length = 16) {
     $string = uniqid(rand()); 
     $randomString = substr($string, 0, $length);
      return $randomString; 
    }

?>