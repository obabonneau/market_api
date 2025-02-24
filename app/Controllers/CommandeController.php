<?php

// UTILISATION DE CLASSES
require_once "../app/Entities/Commande.php";
require_once "../app/Models/CommandeModel.php";

// -------------------------------------
// CLASSE CONTROLEUR DE L'ENTITE PRODUIT
// -------------------------------------
class CommandeController
{
    // --------------------------------
    // METHODE POUR LISTER LES PRODUITS
    // --------------------------------
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

    // -----------------------------------------------
    // METHODE POUR LISTER LES PRODUITS D'UNE COMMANDE
    // -----------------------------------------------
    public function listProductsByOrder()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            $id_commande = $_GET["id_commande"] ?? null;

            if ($id_commande) {

                $commandeModel = new CommandeModel();
                $produits = $commandeModel->listProductsByOrder($id_commande);

                if ($produits) {
                    http_response_code(200); // 200 OK
                    echo json_encode($produits);
                } else {
                    http_response_code(404); // 404 Not Found
                    echo json_encode(["message" => "Produits de la commande non trouvés !"]);
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

    // -------------------------------
    // METHODE POUR CREER UNE COMMANDE
    // -------------------------------
    public function add()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $rawData = file_get_contents('php://input');
            $data = json_decode($rawData, true);
            $id_statut = 2;
            $id_client = $data['id_client'] ?? null;
            $num_commande = (new DateTime())->getTimestamp();
            $date_commande = (new DateTime())->format('Y-m-d');
            $prenom = $data['prenom'] ?? null;
            $nom = $data['nom'] ?? null;
            $email = $data['email'] ?? null;
            $adresse = $data['adresse'] ?? null;
            $cp = $data['cp'] ?? null;
            $ville = $data['ville'] ?? null;
            $produits = $data['produits'] ?? [];

            if ($id_statut && $id_client &&  $num_commande && $date_commande && $prenom && $nom && $email && $adresse && $cp && $ville  && count($produits) !== 0) {

                $commandeModel = new CommandeModel();
                $success = $commandeModel->createOrder($id_statut, $id_client, $num_commande, $date_commande, $prenom, $nom, $email, $adresse, $cp, $ville, $produits);

                if ($success) {
                    http_response_code(201); // 200 OK
                    echo json_encode(["message" => "Commande crée avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de la création de la commande !"]);
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message" => "Méthode non autorisée !"]);
        }
    }
}
