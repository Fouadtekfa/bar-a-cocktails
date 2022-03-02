<?php

namespace bar;

class EntiteLienCocktailVerre
{
    protected int $c_id;
    protected int $v_id;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteLienCocktailVerre
     */
    public function setCId(int $c_id): EntiteLienCocktailVerre
    {
        $this->c_id = $c_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getVId(): int
    {
        return $this->v_id;
    }

    /**
     * @param int $v_id
     * @return EntiteLienCocktailVerre
     */
    public function setVId(int $v_id): EntiteLienCocktailVerre
    {
        $this->v_id = $v_id;
        return $this;
    }


}