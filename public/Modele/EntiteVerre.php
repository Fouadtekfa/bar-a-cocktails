<?php
namespace bar;
class EntiteVerre{
    protected int $v_id;
    protected string $v_type;


    /**
     * @return int
     */
    public function getVId(): int
    {
        return $this->v_id;
    }

    /**
     * @param int $v_id
     */
    public function setVId(int $v_id): void
    {
        $this->v_id = $v_id;
    }

    /**
     * @return String
     */
    public function getVType(): String
    {
        return $this->v_type;
    }

    /**
     * @param String $v_typ
     */
    public function setVType(String $v_type): void
    {
        $this->v_type = $v_type;
    }


}
?>
