<?php

// UTILISATION DE CLASSES
require_once "../App/Core/DbConnect.php";

// --------------------------------
// CLASSE MODEL DE L'ENTITE PRODUIT
// --------------------------------
class ClientModel extends DbConnect
{
  // ------------------------------------------------------------
  // METHODE POUR CREER LES INFOS D'UN CLIENT EN BDD BACK-OFFICE
  // APRES QU'IL AIT PASSE SA COMMANDE SUR LE SITE E-COMMERCE
  // -----------------------------------------------------------
  public function createClient(Client $client)
  {
    try {
      // PREPARATION DE LA REQUETE SQL
      $this->request = $this->connection->prepare("INSERT INTO com_infos_client
                                                         VALUES (NUll, :prenom, :nom, :email, :adresse, :cp, :ville)");
      $this->request->bindValue(':prenom', $client->getPrenom());
      $this->request->bindValue(':nom', $client->getNom());
      $this->request->bindValue(':email', $client->getEmail());
      $this->request->bindValue(':adresse', $client->getAdresse());
      $this->request->bindValue(':cp', $client->getCp());
      $this->request->bindValue(':ville', $client->getVille());

      // EXECUTION DE LA REQUETE SQL
      return $this->request->execute();
    } catch (PDOException $e) {
      //echo $e->getMessage();
      //die;
    }
  }
}
