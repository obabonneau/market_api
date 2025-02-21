<?php

// ---------------------
// CLASSE ET BDD PRODUIT
// ---------------------
class Client
{
  // ----------
  // ATTRIBUTS
  // ----------
  private $id_client;
  private $prenom;
  private $nom;
  private $email;
  private $adresse;
  private $cp;
  private $ville;

  // --------------------------
  // METHODES GETTER ET SETTER
  // --------------------------

  public function getId_client()
  {
    return $this->id_client;
  }

  public function setId_client($id_client)
  {
    $this->id_client = $id_client;

    return $this;
  }

  public function getPrenom()
  {
    return $this->prenom;
  }

  public function setPrenom($prenom)
  {
    $this->prenom = $prenom;

    return $this;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  public function getAdresse()
  {
    return $this->adresse;
  }

  public function setAdresse($adresse)
  {
    $this->adresse = $adresse;

    return $this;
  }

  public function getCp()
  {
    return $this->cp;
  }

  public function setCp($cp)
  {
    $this->cp = $cp;

    return $this;
  }

  public function getVille()
  {
    return $this->ville;
  }

  public function setVille($ville)
  {
    $this->ville = $ville;

    return $this;
  }
}
