<?php

// ---------------------
// CLASSE ET BDD PRODUIT
// ---------------------
class Categorie
{
  // ----------
  // ATTRIBUTS
  // ----------
  private $id_categorie;
  private $categorie;

  // --------------------------
  // METHODES GETTER ET SETTER
  // --------------------------

  public function getId_categorie()
  {
    return $this->id_categorie;
  }

  public function setId_categorie($id_categorie)
  {
    $this->id_categorie = $id_categorie;

    return $this;
  }

  public function getCategorie()
  {
    return $this->categorie;
  }

  public function setCategorie($categorie)
  {
    $this->categorie = $categorie;

    return $this;
  }
}
