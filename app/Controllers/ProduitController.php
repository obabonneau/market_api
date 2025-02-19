<?php

// UTILISATION DE CLASSES
require_once "../app/Entities/Produit.php";
require_once "../app/Models/ProduitModel.php";

////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE PRODUIT //
////////////////////////////////////////////
class ProduitController
{
    ///////////////////////////////////////
    // METHODE POUR LISTER LES PRODUITS //
    ///////////////////////////////////////
    public function list()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            $readProduitModel = new ProduitModel();
            $produits = $readProduitModel->readAll();

            if ($produits) {
                http_response_code(200); // 200 OK
                echo json_encode($produits);
            } else {
                http_response_code(404); // 404 Not Found
                echo json_encode(["message" => "Aucuns produits trouvés !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message" => "Méthode non autorisée !"]);
        }
    }
    ////////////////////////////////////////
    // METHODE POUR AFFICHER UNE PRODUIT //
    ////////////////////////////////////////
    public function show()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            $id_produit = $_GET["id_produit"] ?? null;

            if ($id_produit) {

                $readProduit = new Produit();
                $readProduit->setId_produit($id_produit);

                $readProduitModel = new ProduitModel();
                $produit = $readProduitModel->read($readProduit);

                if ($produit) {
                    http_response_code(200); // 200 OK
                    echo json_encode($produit);
                } else {
                    http_response_code(404); // 404 Not Found
                    echo json_encode(["message" => "Produit introuvable !"]);
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
    /*
    /////////////////////////////////////
    // METHODE POUR CREER UNE PRODUIT //
    /////////////////////////////////////
    public function create()
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
            $title = $data['title'] ?? null;
            $description = $data['description'] ?? null;
            $created_at = $data['created_at'] ?? null;

            if ($title && $description && $created_at) {

                //
                $addProduit = new Produit();
                $addProduit->setTitle($title);
                $addProduit->setDescription($description);
                $addProduit->setCreated_at($created_at);

                $addProduitModel = new ProduitModel();
                $success = $addProduitModel->create($addProduit);

                if ($success) {
                    http_response_code(201); // 200 OK
                    echo json_encode(["message" => "Création ajoutée avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de l'ajout de la création !"]);
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

    ////////////////////////////////////////
    // METHODE POUR MODIFIER UNE PRODUIT //
    ////////////////////////////////////////
    public function update()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            $rawData = file_get_contents('php://input');
            $data = json_decode($rawData, true);
            $id_produit = $data['id_produit'] ?? null;
            $title = $data['title'] ?? null;
            $description = $data['description'] ?? null;
            $created_at = $data['created_at'] ?? null;

            if ($id_produit && $title && $description && $created_at)
            {
                $majProduit = new Produit();
                $majProduit->setId_produit($id_produit);
                $majProduit->setTitle($title);
                $majProduit->setDescription($description);
                $majProduit->setCreated_at($created_at);

                $majProduitModel = new ProduitModel();
                $success = $majProduitModel->update($majProduit);

                if ($success) {
                    http_response_code(200); // 200 OK
                    echo json_encode(["message" => "Création mise à jour avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de la mise à jour de la création !"]);
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

    /////////////////////////////////////////
    // METHODE POUR SUPPRIMER UNE PRODUIT //
    /////////////////////////////////////////
    public function delete()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

            $rawData = file_get_contents('php://input');
            $data = json_decode($rawData, true);
            $id_produit = $data['id_produit'] ?? null;

            if ($id_produit) {

                $delProduit = new Produit();
                $delProduit->setId_produit($id_produit);

                $delProduitModel = new ProduitModel();
                $success = $delProduitModel->delete($delProduit);

                if ($success) {
                    http_response_code(200); // 200 OK
                    echo json_encode("Création supprimée avec succès !");
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode("ERREUR lors de la suppression de la création !");
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode("Paramètres non spécifiés ou manquants !");
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode("Méthode non autorisée !");
        }
    }
        */
}
