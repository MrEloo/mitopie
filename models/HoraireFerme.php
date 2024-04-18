<?php

class HoraireFerme
{
    private ?int $id = null;

    public function __construct(private string $jour, private string $ouverture, private string $fermeture)
    {
        $this->jour = $jour;
        $this->ouverture = $ouverture;
        $this->fermeture = $fermeture;
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
     * Get the value of jour
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set the value of jour
     *
     * @return  self
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get the value of ouverture
     */
    public function getOuverture()
    {
        return $this->ouverture;
    }

    /**
     * Set the value of ouverture
     *
     * @return  self
     */
    public function setOuverture($ouverture)
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    /**
     * Get the value of fermeture
     */
    public function getFermeture()
    {
        return $this->fermeture;
    }

    /**
     * Set the value of fermeture
     *
     * @return  self
     */
    public function setFermeture($fermeture)
    {
        $this->fermeture = $fermeture;

        return $this;
    }
}
