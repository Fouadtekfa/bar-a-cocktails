<?php
namespace bar;

class EntiteBoissons{
    protected $b_id;
    protected  $b_nom;
    protected  $b_type;
    protected  $b_estAlicolise;
    protected  $qteStockee;

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
    public function getBEstAlicolise(): int
    {
        return $this->b_estAlicolise;
    }

    /**
     * @param int $b_estAlicolise
     */
    public function setBEstAlicolise(int $b_estAlicolise): void
    {
        $this->b_estAlicolise = $b_estAlicolise;
    }

    /**
     * @return int
     */
    public function getQteStockee(): int
    {
        return $this->qteStockee;
    }

    /**
     * @param int $qteStockee
     */
    public function setQteStockee(int $qteStockee): void
    {
        $this->qteStockee = $qteStockee;
    }


}
?>