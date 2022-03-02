<?php

namespace bar;

class EntiteLienCocktailUstensile
{
    protected int $c_id;
    protected int $u_id;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     * @return EntiteLienCocktailUstensile
     */
    public function setCId(int $c_id): EntiteLienCocktailUstensile
    {
        $this->c_id = $c_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUId(): int
    {
        return $this->u_id;
    }

    /**
     * @param int $u_id
     * @return EntiteLienCocktailUstensile
     */
    public function setUId(int $u_id): EntiteLienCocktailUstensile
    {
        $this->u_id = $u_id;
        return $this;
    }

    
}