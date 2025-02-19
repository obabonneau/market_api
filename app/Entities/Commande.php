<?php

////////////////////////////
// CLASSE ET BDD PRODUIT //
////////////////////////////
class Commande
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_commande;
    private $id_statut;
    private $id_client;
    private $num_commande;
    private $date_commande;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getId_commande()
    {
        return $this->id_commande;
    }

    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getId_statut()
    {
        return $this->id_statut;
    }

    public function setId_statut($id_statut)
    {
        $this->id_statut = $id_statut;

        return $this;
    }

    public function getId_client()
    {
        return $this->id_client;
    }

    public function setId_client($id_client)
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getNum_commande()
    {
        return $this->num_commande;
    }

    public function setNum_commande($num_commande)
    {
        $this->num_commande = $num_commande;

        return $this;
    }

    public function getDate_commande()
    {
        return $this->date_commande;
    }

    public function setDate_commande($date_commande)
    {
        $this->date_commande = $date_commande;

        return $this;
    }
}
