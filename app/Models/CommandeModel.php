<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

// --------------------------------
// CLASSE MODEL DE L'ENTITE PRODUIT
// --------------------------------
class CommandeModel extends DbConnect
{
    // --------------------------------------------------
    // METHODE POUR LIRE LES COMMANDES D'UN CLIENT EN BDD
    // --------------------------------------------------
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

    // ----------------------------------------------------
    // METHODE POUR LIRE LES PRODUITS D'UNE COMMANDE EN BDD
    // ----------------------------------------------------
    public function listProductsByOrder($id_commande)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT
                                                             pc.*,
                                                             p.id_categorie,
                                                             p.produit,
                                                             p.marque,
                                                             p.description,
                                                             p.prix,
                                                             p.image
                                                         FROM
                                                             com_produit_commande pc
                                                         INNER JOIN com_produit p ON
                                                             p.id_produit = pc.id_produit
                                                         WHERE
                                                             pc.id_commande = :id_commande");

            $this->request->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $produits = $this->request->fetchAll();

            // RETOUR DU RESULTAT
            return $produits;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    // -------------------------------
    // METHODE POUR CREER UNE COMMANDE
    // -------------------------------
    public function createOrder($id_statut, $id_client, $num_commande, $date_commande, $produits)
    {

        // Start transaction
        $this->connection->beginTransaction();

        try {
            // Insert command
            $this->request = $this->connection->prepare("INSERT INTO com_commande
                                                         VALUES
                                                         (NULL,
                                                          :id_statut,
                                                          :id_client,
                                                          :num_commande,
                                                          :date_commande)");

            $this->request->bindValue(':id_statut', $id_statut);
            $this->request->bindValue(':id_client', $id_client);
            $this->request->bindValue(':num_commande', $num_commande);
            $this->request->bindValue(':date_commande', $date_commande);

            // EXECUTION DE LA 1ERE REQUETE SQL
            $this->request->execute();
            $id_commande = $this->connection->lastInsertId();

            // Insert command lines
            $this->request = $this->connection->prepare("INSERT INTO com_produit_commande
                                                         VALUES (NULL, :id_produit, :id_commande, :quantite, :prix)");

            foreach ($produits as  $produit) {

                $id_produit = $produit['id_produit'];
                $quantite = $produit['quantite'];
                $prix = $produit['prix'];

                $this->request->bindValue(':id_produit', $id_produit);
                $this->request->bindValue(':id_commande', $id_commande);
                $this->request->bindValue(':quantite', $quantite);
                $this->request->bindValue(':prix', $prix);

                // EXECUTION DE LA 2E REQUETE SQL
                $this->request->execute();
            }

            // Commit transaction
            return $this->connection->commit();
        } catch (PDOException $e) {
            // Rollback transaction
            $this->connection->rollback();
            return false;
        }
    }
}
