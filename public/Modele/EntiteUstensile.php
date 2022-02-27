<?php
namespace bar;

class EntiteUstensile {

    protected int $u_id;
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
    public function getUId(): int
    {
        return $this->u_id;
    }

    /**
     * @param int $u_id
     */
    public function setUId(int $u_id): void
    {
        $this->u_id = $u_id;
    }
}