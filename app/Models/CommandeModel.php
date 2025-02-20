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
    // METHODE POUR CREER UNE COMMANDE ET LA RELIER A UN CLIENT
    // (LA COMMANDE SERA "REMPLIE" DE PRODUITS VIA UNE AUTRE METHODE)
    // -------------------------------
    public function createClientOrder(Commande $commande)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO com_commande
                                                         VALUES
                                                         (NULL,
                                                          :id_statut,
                                                          :id_client,
                                                          :num_commande,
                                                          :date_commande)");

            $this->request->bindValue(':id_statut', $commande->getId_statut());
            $this->request->bindValue(':id_client', $commande->getId_client());
            $this->request->bindValue(':num_commande', $commande->getNum_commande());
            $this->request->bindValue(':date_commande', $commande->getDate_commande());

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // Récupération de l'ID de la commande crée avec lastInsertId()
            $lastId = $this->connection->lastInsertId();
            return $lastId;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    // -------------------------------
    // METHODE POUR AJOUTER UN PRODUIT DANS UNE COMMANDE (ICI, PAS DE LIEN AVEC UN CLIENT)
    // -------------------------------
    public function addProductToOrder($id_produit, $id_commande, $quantite)
    {

        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO com_commande
                                                         VALUES (NULL, :id_produit, :id_commande, :quantite)");

            $this->request->bindValue(':id_produit', $id_produit);
            $this->request->bindValue(':id_commande', $id_commande);
            $this->request->bindValue(':quantite', $quantite);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}
