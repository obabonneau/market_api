<?php

////////////////////////////
// CLASSE ET BDD CREATION //
////////////////////////////
class Creation
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_creation;
    private $title;
    private $description;
    private $created_at;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getId_creation()
    {
        return $this->id_creation;
    }

    public function setId_creation($id_creation)
    {
        $this->id_creation = $id_creation;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

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

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}