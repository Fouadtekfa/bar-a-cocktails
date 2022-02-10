<?php
class EntiteCocktail{
protected int $c_id;
protected string $c_nom;
protected string $c_cat;
protected float $c_prix;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     */
    public function setCId(int $c_id): void
    {
        $this->c_id = $c_id;
    }

    /**
     * @return string
     */
    public function getCNom(): string
    {
        return $this->c_nom;
    }

    /**
     * @param string $c_nom
     */
    public function setCNom(string $c_nom): void
    {
        $this->c_nom = $c_nom;
    }

    /**
     * @return string
     */
    public function getCCat(): string
    {
        return $this->c_cat;
    }

    /**
     * @param string $c_cat
     */
    public function setCCat(string $c_cat): void
    {
        $this->c_cat = $c_cat;
    }

    /**
     * @return float
     */
    public function getCPrix(): float
    {
        return $this->c_prix;
    }

    /**
     * @param float $c_prix
     */
    public function setCPrix(float $c_prix): void
    {
        $this->c_prix = $c_prix;
    }





}