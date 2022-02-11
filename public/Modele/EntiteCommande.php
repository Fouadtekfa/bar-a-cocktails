<?php
namespace bar;

class EntiteCommande{
    protected  $com_id;
    protected  $com_numTable;

    /**
     * @return int
     */
    public function getComId(): int
    {
        return $this->com_id;
    }

    /**
     * @param int $com_id
     */
    public function setComId(int $com_id): void
    {
        $this->com_id = $com_id;
    }




}
?>