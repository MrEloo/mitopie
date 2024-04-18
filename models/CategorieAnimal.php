<?php

class CategorieAnimal
{
    private ?int $id = null;
    private ?array $products_alive = [];

    public function __construct(private string $nom, private string $media, private string $logo)
    {
        $this->nom = $nom;
        $this->media = $media;
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
     * Get the value of prducts_alive
     */
    public function getProducts_alive()
    {
        return $this->products_alive;
    }

    /**
     * Set the value of prducts_alive
     *
     * @return  self
     */
    public function setProducts_alive($products_alive)
    {
        $this->products_alive = $products_alive;

        return $this;
    }

    /**
     * Get the value of logo
     */ 
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @return  self
     */ 
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }
}
