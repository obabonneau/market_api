<?php

// UTILISATION DE CLASSES
require_once "..app/Entities/Creation.php";
require_once "..app/Models/CreationModel.php";

////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE CREATION //
////////////////////////////////////////////
class CreationController
{
    ///////////////////////////////////////
    // METHODE POUR LISTER LES CREATIONS //
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
        
            $readCreationModel = new CreationModel();
            $creations = $readCreationModel->readAll();
        
            if ($creations) {
                http_response_code(200); // 200 OK
                echo json_encode($creations);
            } else {
                http_response_code(404); // 404 Not Found
                echo json_encode(["message" => "Aucunes créations trouvées !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message" => "Méthode non autorisée !"]);
        }
    }

    ////////////////////////////////////////
    // METHODE POUR AFFICHER UNE CREATION //
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
        
            $id_creation = $_GET["id_creation"] ?? null;

            if ($id_creation) {

                $readCreation = new Creation();
                $readCreation->setId_creation($id_creation);

                $readCreationModel = new CreationModel();
                $creation = $readCreationModel->read($readCreation);

                if ($creation) {
                    http_response_code(200); // 200 OK
                    echo json_encode($creation);
                } else {
                    http_response_code(404); // 404 Not Found
                    echo json_encode(["message" => "Création introuvable !"]);
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

    /////////////////////////////////////
    // METHODE POUR CREER UNE CREATION //
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
                $addCreation = new Creation();                               
                $addCreation->setTitle($title);
                $addCreation->setDescription($description);
                $addCreation->setCreated_at($created_at);

                $addCreationModel = new CreationModel();
                $success = $addCreationModel->create($addCreation); 

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
    // METHODE POUR MODIFIER UNE CREATION //
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
            $id_creation = $data['id_creation'] ?? null;
            $title = $data['title'] ?? null;
            $description = $data['description'] ?? null;
            $created_at = $data['created_at'] ?? null;

            if ($id_creation && $title && $description && $created_at)
            {
                $majCreation = new Creation(); 
                $majCreation->setId_creation($id_creation);                              
                $majCreation->setTitle($title);
                $majCreation->setDescription($description);
                $majCreation->setCreated_at($created_at);

                $majCreationModel = new CreationModel();
                $success = $majCreationModel->update($majCreation);

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
    // METHODE POUR SUPPRIMER UNE CREATION //
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
            $id_creation = $data['id_creation'] ?? null;

            if ($id_creation) {

                $delCreation = new Creation();
                $delCreation->setId_creation($id_creation);
                
                $delCreationModel = new CreationModel();
                $success = $delCreationModel->delete($delCreation);

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
}