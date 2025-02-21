<?php

// UTILISATION DE CLASSES
require_once "../app/Entities/Categorie.php";
require_once "../app/Models/CategorieModel.php";

// -------------------------------------
// CLASSE CONTROLEUR DE L'ENTITE CATEGORIE
// -------------------------------------
class CategorieController
{
  // --------------------------------
  // METHODE POUR LISTER LES PRODUITS
  // --------------------------------
  public function list()
  {
    // HEADER JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {

      $categorieModel = new CategorieModel();
      $categories = $categorieModel->findAll();

      if ($categories) {
        http_response_code(200); // 200 OK
        echo json_encode($categories);
      } else {
        http_response_code(404); // 404 Not Found
        echo json_encode(["message" => "Categories introuvables !"]);
      }
    } else {
      http_response_code(405); // 405 Method Not Allowed
      echo json_encode("ERREUR : Méthode non autorisée !");
    }
  }
}
