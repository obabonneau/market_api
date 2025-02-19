<?php

// UTILISATION DE CLASSES
require_once "../app/Entities/Commande.php";
require_once "../app/Models/CommandeModel.php";

////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE PRODUIT //
////////////////////////////////////////////
class CommandeController
{
    ///////////////////////////////////////
    // METHODE POUR LISTER LES PRODUITS //
    ///////////////////////////////////////
    public function listByClient()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            $id_client = $_GET["id_client"] ?? null;

            if ($id_client) {

                $commandeModel = new CommandeModel();
                $commandes = $commandeModel->readByClient($id_client);

                if ($commandes) {
                    http_response_code(200); // 200 OK
                    echo json_encode($commandes);
                } else {
                    http_response_code(404); // 404 Not Found
                    echo json_encode(["message" => "Commande introuvable !"]);
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode("ERREUR : Méthode non autorisée !");
        }
    }
}
