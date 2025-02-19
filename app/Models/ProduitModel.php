<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

///////////////////////////////////////
// CLASSE MODEL DE L'ENTITE PRODUIT //
///////////////////////////////////////
class ProduitModel extends DbConnect
{
    ///////////////////////////////////////////
    // METHODE POUR LIRE UNE PRODUIT EN BDD //
    ///////////////////////////////////////////
    public function read(Produit $readProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT
                                                             com_produit.*,
                                                             com_categorie.categorie AS categorie
                                                         FROM
                                                             com_produit
                                                         INNER JOIN com_categorie ON com_produit.id_categorie = com_categorie.id_categorie
                                                         WHERE com_produit.id_produit = :id_produit");

            $this->request->bindValue(':id_produit', $readProduit->getId_produit());

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $produit = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $produit;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////////////
    // METHODE POUR LIRE LES PRODUITS EN BDD //
    ////////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT
                                                            com_produit.*,
                                                            com_categorie.categorie AS categorie
                                                        FROM
                                                            com_produit
                                                        INNER JOIN com_categorie ON com_produit.id_categorie = com_categorie.id_categorie");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $produits = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $produits;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
    /*
    ////////////////////////////////////////////
    // METHODE POUR CREER UNE PRODUIT EN BDD //
    ////////////////////////////////////////////
    public function create(Produit $addProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO produit (title, description, created_at)
                VALUES (:title, :description, :created_at)");
            $this->request->bindValue(':title', $addProduit->getTitle());
            $this->request->bindValue(':description', $addProduit->getDescription());
            $this->request->bindValue(':created_at', $addProduit->getCreated_at());

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////////////////
    // METHODE DE MODIFICATION D'UNE PRODUIT EN BDD //
    ///////////////////////////////////////////////////
    public function update(Produit $majProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE produit SET
                title = :title,
                description = :description,
                created_at = :created_at
                WHERE id_produit = :id_produit");
            $this->request->bindValue(':id_produit', $majProduit->getId_produit());
            $this->request->bindValue(':title', $majProduit->getTitle());
            $this->request->bindValue(':description', $majProduit->getDescription());
            $this->request->bindValue(':created_at', $majProduit->getCreated_at());

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////////////////
    // METHODE DE SUPPRESSION D'UNE PRODUIT EN BDD //
    //////////////////////////////////////////////////
    public function delete(Produit $delProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
            $this->request->bindValue(':id_produit', $delProduit->getId_produit());

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L'EXECUTION
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
        */
}
