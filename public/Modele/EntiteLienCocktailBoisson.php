<?php

namespace bar;

class EntiteLienCocktailBoisson
{
    protected int $c_id;
    protected int $b_id;
    protected $qteBoisson;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteLienCocktailBoisson
     */
    public function setCId(int $c_id): EntiteLienCocktailBoisson
    {
        $this->c_id = $c_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBId()
    {
        return $this->b_id;
    }

    /**
     * @param mixed $b_id
     * @return EntiteLienCocktailBoisson
     */
    public function setBId($b_id)
    {
        $this->b_id = $b_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQteBoisson()
    {
        return $this->qteBoisson;
    }

    /**
     * @param mixed $qteBoisson
     * @return EntiteLienCocktailBoisson
     */
    public function setQteBoisson($qteBoisson)
    {
        $this->qteBoisson = $qteBoisson;
        return $this;
    }


}