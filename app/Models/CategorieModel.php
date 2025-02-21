<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

// --------------------------------
// CLASSE MODEL DE L'ENTITE CATEGORIE
// --------------------------------
class CategorieModel extends DbConnect
{
  // --------------------------------
  // METHODE POUR LIRE LES CATEGORIES
  // --------------------------------
  public function findAll()
  {
    try {
      // PREPARATION DE LA REQUETE SQL
      $this->request = $this->connection->prepare("SELECT * FROM com_categorie");

      // EXECUTION DE LA REQUETE SQL
      $this->request->execute();

      // FORMATAGE DU RESULTAT DE LA REQUETE
      $categories = $this->request->fetchAll();

      // RETOUR DU RESULTAT
      return $categories;
    } catch (PDOException $e) {
      //echo $e->getMessage();
      //die;
      return false;
    }
  }
}
