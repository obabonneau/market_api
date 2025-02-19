<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

///////////////////////////////////////
// CLASSE MODEL DE L'ENTITE PRODUIT //
///////////////////////////////////////
class CommandeModel extends DbConnect
{
    ///////////////////////////////////////////
    // METHODE POUR LIRE LES COMMANDES D'UN CLIENT EN BDD //
    ///////////////////////////////////////////
    public function readByClient($id_client)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_commande
                                                         WHERE id_client = :id_client");

            $this->request->bindValue(':id_client', $id_client, PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $produit = $this->request->fetchAll();

            // RETOUR DU RESULTAT
            return $produit;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}
