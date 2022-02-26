<?php

namespace bar;

class EntiteCocktailIngredient
{
    protected int $c_id;
    protected int $i_id;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteCocktailIngredient
     */
    public function setCId(int $c_id): EntiteCocktailIngredient
    {
        $this->c_id = $c_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIId(): int
    {
        return $this->i_id;
    }

    /**
     * @param int $i_id
     * @return EntiteCocktailIngredient
     */
    public function setIId(int $i_id): EntiteCocktailIngredient
    {
        $this->i_id = $i_id;
        return $this;
    }



}