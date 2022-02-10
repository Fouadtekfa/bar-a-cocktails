<?php

class EntiteUtensiles {

    protected int $d_id;
    protected string $u_nom;

    /**
     * @return string
     */
    public function getUNom(): string
    {
        return $this->u_nom;
    }

    /**
     * @param string $u_nom
     */
    public function setUNom(string $u_nom): void
    {
        $this->u_nom = $u_nom;
    }

    /**
     * @return int
     */
    public function getDId(): int
    {
        return $this->d_id;
    }

    /**
     * @param int $d_id
     */
    public function setDId(int $d_id): void
    {
        $this->d_id = $d_id;
    }
}