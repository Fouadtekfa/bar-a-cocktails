<?php

namespace bar;

class EntiteLienCocktailIngredient
{
    protected int $c_id;
    protected int $i_id;
    protected $qteIngredient;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteLienCocktailIngredient
     */
    public function setCId(int $c_id): EntiteLienCocktailIngredient
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
     * @return EntiteLienCocktailIngredient
     */
    public function setIId(int $i_id): EntiteLienCocktailIngredient
    {
        $this->i_id = $i_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQteIngredient()
    {
        return $this->qteIngredient;
    }

    /**
     * @param mixed $qteIngredient
     * @return EntiteLienCocktailIngredient
     */
    public function setQteIngredient($qteIngredient)
    {
        $this->qteIngredient = $qteIngredient;
        return $this;
    }



}