<?php

class EntiteEtape{
protected int $c_id;
protected int  $e_num;
protected string  $e_desc;

    /**
     * @return int
     */
    public function getCId(): int
    {
        return $this->c_id;
    }

    /**
     * @param int $c_id
     */
    public function setCId(int $c_id): void
    {
        $this->c_id = $c_id;
    }

    /**
     * @return int
     */
    public function getENum(): int
    {
        return $this->e_num;
    }

    /**
     * @param int $e_num
     */
    public function setENum(int $e_num): void
    {
        $this->e_num = $e_num;
    }

    /**
     * @return string
     */
    public function getEDesc(): string
    {
        return $this->e_desc;
    }

    /**
     * @param string $e_desc
     */
    public function setEDesc(string $e_desc): void
    {
        $this->e_desc = $e_desc;
    }



}
