<?php

//////////////////////////////////////////////
// CLASSE DE CONNEXION A LA BASE DE DONNEES //
//////////////////////////////////////////////
abstract class DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    protected $connection;
    protected $request;

    //////////////////////////////////////////////////
    // CONSTANTES DE CONNEXION A LA BASE DE DONNEES //
    //////////////////////////////////////////////////
    const SERVER = "sqlprive-pc2372-001.eu.clouddb.ovh.net:35167";
    const USER = "cefiidev1422";
    const PASSWORD = "q2KH6vM3k";
    const BASE = "cefiidev1422";

    ////////////////////////////////////////////////
    // CONSTRUCTEUR POUR INITIALISER LA CONNEXION //
    ////////////////////////////////////////////////
    public function __construct()
    {
        try {
            // CRÉATION D'UNE INSTANCE PDO
            $this->connection = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE, self::USER, self::PASSWORD);

            // DÉFINITION DU MODE DE GESTION DES ERREURS EN MODE EXCEPTION
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // RETOUR DES REQUETES DANS UN TABLEAU D'OBJET PAR DEFAUT
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // ENCODAGE DES CARACTERES SPECIAUX EN UTF8
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");

        } catch (Exception $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}