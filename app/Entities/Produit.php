<?php

// ---------------------
// CLASSE ET BDD PRODUIT
// ---------------------
class Produit
{
    // ---------
    // ATTRIBUTS
    // ---------
    private $id_produit;
    private $id_categorie;
    private $produit;
    private $marque;
    private $description;
    private $prix;
    private $image;

    // -------------------------
    // METHODES GETTER ET SETTER
    // -------------------------
    public function getId_produit()
    {
        return $this->id_produit;
    }

    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getId_categorie()
    {
        return $this->id_categorie;
    }


    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    public function getProduit()
    {
        return $this->produit;
    }

    public function setProduit($produit)
    {
        $this->produit = $produit;

        return $this;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
