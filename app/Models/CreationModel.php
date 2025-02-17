<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

///////////////////////////////////////
// CLASSE MODEL DE L'ENTITE CREATION //
///////////////////////////////////////
class CreationModel extends DbConnect
{
    ///////////////////////////////////////////
    // METHODE POUR LIRE UNE CREATION EN BDD //
    ///////////////////////////////////////////
    public function read(Creation $readCreation)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM creation WHERE id_creation = :id_creation");
            $this->request->bindValue(':id_creation', $readCreation->getId_creation());

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $creation = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $creation;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////////////
    // METHODE POUR LIRE LES CREATIONS EN BDD //
    ////////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM creation");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $creations = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $creations;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////////////
    // METHODE POUR CREER UNE CREATION EN BDD //
    ////////////////////////////////////////////
    public function create(Creation $addCreation)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO creation (title, description, created_at)
                VALUES (:title, :description, :created_at)");
            $this->request->bindValue(':title', $addCreation->getTitle());
            $this->request->bindValue(':description', $addCreation->getDescription());
            $this->request->bindValue(':created_at', $addCreation->getCreated_at());

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////////////////
    // METHODE DE MODIFICATION D'UNE CREATION EN BDD //
    ///////////////////////////////////////////////////
    public function update(Creation $majCreation)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE creation SET
                title = :title,
                description = :description,
                created_at = :created_at
                WHERE id_creation = :id_creation");
            $this->request->bindValue(':id_creation', $majCreation->getId_creation());
            $this->request->bindValue(':title', $majCreation->getTitle());
            $this->request->bindValue(':description', $majCreation->getDescription());
            $this->request->bindValue(':created_at', $majCreation->getCreated_at());

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////////////////
    // METHODE DE SUPPRESSION D'UNE CREATION EN BDD //
    //////////////////////////////////////////////////
    public function delete(Creation $delCreation)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM creation WHERE id_creation = :id_creation");
            $this->request->bindValue(':id_creation', $delCreation->getId_creation());

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L'EXECUTION
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}