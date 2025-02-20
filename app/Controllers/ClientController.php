<?php

// UTILISATION DE CLASSES
require_once "../app/Entities/Client.php";
require_once "../app/Models/ClientModel.php";

// -------------------------------------
// CLASSE CONTROLEUR DE L'ENTITE PRODUIT
// -------------------------------------
class ClientController
{

  // -------------------------------------------
  // METHODE POUR CREER LES INFOS CLIENT EN BDD
  // SUITE A UNE COMMANDE FAITE PAR UN CLIENT SUR LE SITE E-COMMERCE
  // -------------------------------------------
  public function createClient()
  {

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      //
      $rawData = file_get_contents('php://input');
      $data = json_decode($rawData, true);
      $nom = $data['nom'] ?? null;
      $prenom = $data['prenom'] ?? null;
      $email = $data['email'] ?? null;
      $adresse = $data['adresse'] ?? null;
      $cp = $data['cp'] ?? null;
      $ville = $data['ville'] ?? null;

      if ($nom && $prenom && $email && $adresse && $cp && $ville) {

        //
        $client = new Client();
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setEmail($email);
        $client->setAdresse($adresse);
        $client->setCp($cp);
        $client->setVille($ville);

        $clientModel = new ClientModel();
        $success = $clientModel->createClient($client);

        if ($success) {
          http_response_code(201); // 200 OK
          echo json_encode(["message" => "Client ajouté avec succès !"]);
        } else {
          http_response_code(503); // 503 Service Unavailable
          echo json_encode(["message" => "ERREUR lors de l'ajout du client !"]);
        }
      } else {
        http_response_code(400); // 400 Bad Request
        echo json_encode(["message" => "Paramètres manquants !"]);
      }
    } else {
      http_response_code(405); // 405 Method Not Allowed
      echo json_encode("Méthode non autorisée !");
    }
  }
}
