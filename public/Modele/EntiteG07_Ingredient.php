<?php
namespace bar;
class EntiteG07_Ingredient{
    protected int $i_id;
    protected string $i_nom;
    protected string $i_type;
    protected float $i_qteStockee;
    protected string $i_uniteStockee;

    /**
     * @return int 
     */
    public function getIId(): int
    {
        return $this->i_id;
    }

     /**
     * @param int $i_id
     */
    public function setIId(int $i_id): void
    {
        $this->i_id = $i_id;
    }


    /**
     * @return string 
     */
    public function getINom(): string
    {
        return $this->i_nom;
    }

     /**
     * @param string $i_nom
     */
    public function setINom(string $i_nom): void
    {
        $this->i_nom = $i_nom;
    }


     /**
     * @return string 
     */
    public function getIType(): string
    {
        return $this->i_type;
    }

     /**
     * @param string $i_type
     */
    public function setIType(string $i_type): void
    {
        $this->i_type = $i_type;
    }


      /**
     * @return float 
     */
    public function getIQteStockee(): float
    {
        return $this->i_qteStockee;
    }

     /**
     * @param float $i_qteStockee
     */
    public function setIQteStockee(float $i_qteStockee): void
    {
        $this->i_qteStockee = $i_qteStockee;
    }


  /**
     * @return string 
     */
    public function getIUniteStockee(): string
    {
        return $this->i_uniteStockee;
    }

     /**
     * @param string $i_nom
     */
    public function setIUniteStockee(string $i_uniteStockee): void
    {
        $this->i_uniteStockee = $i_uniteStockee;
    }
  

}
?>
