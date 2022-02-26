<?php

namespace bar;

class EntiteLienCocktailCommande
{
    protected int $c_id;
    protected int $com_id;
    protected int $nbCocktail;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteLienCocktailCommande
     */
    public function setCId(int $c_id): EntiteLienCocktailCommande
    {
        $this->c_id = $c_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getComId(): int
    {
        return $this->com_id;
    }

    /**
     * @param int $com_id
     * @return EntiteLienCocktailCommande
     */
    public function setComId(int $com_id): EntiteLienCocktailCommande
    {
        $this->com_id = $com_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbCocktail(): int
    {
        return $this->nbCocktail;
    }

    /**
     * @param int $nbCocktail
     * @return EntiteLienCocktailCommande
     */
    public function setNbCocktail(int $nbCocktail): EntiteLienCocktailCommande
    {
        $this->nbCocktail = $nbCocktail;
        return $this;
    }



}