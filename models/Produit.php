<?php

class Produit
{
    private ?int $id = null;

    public function __construct(private string $nom, private string $prix, private string $quantite, private string $description, private string $media, private Categorie $categorie)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->description = $description;
        $this->media = $media;
        $this->categorie = $categorie;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

        /**
         * Get the value of prix
         */ 
        public function getPrix()
        {
                return $this->prix;
        }

        /**
         * Set the value of prix
         *
         * @return  self
         */ 
        public function setPrix($prix)
        {
                $this->prix = $prix;

                return $this;
        }

        /**
         * Get the value of quantite
         */ 
        public function getQuantite()
        {
                return $this->quantite;
        }

        /**
         * Set the value of quantite
         *
         * @return  self
         */ 
        public function setQuantite($quantite)
        {
                $this->quantite = $quantite;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of media
         */ 
        public function getMedia()
        {
                return $this->media;
        }

        /**
         * Set the value of media
         *
         * @return  self
         */ 
        public function setMedia($media)
        {
                $this->media = $media;

                return $this;
        }

        /**
         * Get the value of categorie
         */ 
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Set the value of categorie
         *
         * @return  self
         */ 
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;

                return $this;
        }
}
