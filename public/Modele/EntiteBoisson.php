<?php
namespace bar;

class EntiteBoisson{
    protected $b_id;
    protected  $b_nom;
    protected  $b_type;
    protected  $b_estAlcoolise;
    protected  $b_qteStockee;

    /**
     * @return int
     */
    public function getBId(): int
    {
        return $this->b_id;
    }

    /**
     * @param int $b_id
     */
    public function setBId(int $b_id): void
    {
        $this->b_id = $b_id;
    }

    /**
     * @return string
     */
    public function getBNom(): string
    {
        return $this->b_nom;
    }

    /**
     * @param string $b_nom
     */
    public function setBNom(string $b_nom): void
    {
        $this->b_nom = $b_nom;
    }

    /**
     * @return string
     */
    public function getBType(): string
    {
        return $this->b_type;
    }

    /**
     * @param string $b_type
     */
    public function setBType(string $b_type): void
    {
        $this->b_type = $b_type;
    }

    /**
     * @return int
     */
    public function getBEstAlcoolise(): int
    {
        return $this->b_estAlcoolise;
    }

    /**
     * @param int $b_estAlcoolise
     */
    public function setBEstAlicolise(int $b_estAlcoolise): void
    {
        $this->b_estAlcoolise = $b_estAlcoolise;
    }

    /**
     * @return int
     */
    public function getBQteStockee(): int
    {
        return $this->b_qteStockee;
    }

    /**
     * @param int $b_qteStockee
     */
    public function setBQteStockee(int $b_qteStockee): void
    {
        $this->b_qteStockee = $b_qteStockee;
    }


}
?>