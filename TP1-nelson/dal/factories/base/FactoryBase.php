<?php

abstract class FactoryBase
{
    protected function dbConnect()  //Classe dédiée à la connexion à la BD
    {
        $db = null;

        //Ici j'ai jugé important d'attraper des erreurs de connexion à la BD 
        try{
            $db = new \PDO('mysql:host=sql.decinfo-cchic.ca;port=33306;dbname=h24_web_transac_2130331;charset=utf8', 'dev-2130331', 'info2020');
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

        return $db;
    }
}
