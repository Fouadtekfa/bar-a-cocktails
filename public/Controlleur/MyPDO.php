<?php

class MyPDO {
    private PDO $pdo;
    private PDOStatement $pdos_select;
    private PDOStatement $pdos_update;
    private PDOStatement $pdos_insert;
    private PDOStatement $pdos_delete;
    private PDOStatement $pdos_selectAll;
    private string $nomTable;

    public function __construct($sgbd, $host, $db, $user, $password){
        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$db, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function initPDOS_selectAll() {
        $this->pdos_selectAll = $this->pdo->prepare('SELECT * FROM '.$this->nomTable);
    }



    public function getAll(): array {
        if (!isset($this->pdos_selectAll))
            $this->initPDOS_selectAll();
        $this->getPdosSelectAll()->execute();
        return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS,
            "bar\Entite".ucfirst($this->getNomTable()));
    }
    public function initPDOS_select(int $id): void
    {
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE ";
        /*foreach($id as $key=>$val){
            $requete .= "" . $key ."= :" .$key." AND ";
        * a corriger apres
         * /
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE " ;
        $requete = substr($requete,0, strlen($requete)-4);
        $this->pdos_select = $this->pdo->prepare($requete);
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @param PDO $pdo
     * @return MyPDO
     */
    public function setPdo(PDO $pdo): MyPDO
    {
        $this->pdo = $pdo;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosSelect(): PDOStatement
    {
        return $this->pdos_select;
    }

    /**
     * @param PDOStatement $pdos_select
     * @return MyPDO
     */
    public function setPdosSelect(PDOStatement $pdos_select): MyPDO
    {
        $this->pdos_select = $pdos_select;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosUpdate(): PDOStatement
    {
        return $this->pdos_update;
    }

    /**
     * @param PDOStatement $pdos_update
     * @return MyPDO
     */
    public function setPdosUpdate(PDOStatement $pdos_update): MyPDO
    {
        $this->pdos_update = $pdos_update;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosInsert(): PDOStatement
    {
        return $this->pdos_insert;
    }

    /**
     * @param PDOStatement $pdos_insert
     * @return MyPDO
     */
    public function setPdosInsert(PDOStatement $pdos_insert): MyPDO
    {
        $this->pdos_insert = $pdos_insert;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosDelete(): PDOStatement
    {
        return $this->pdos_delete;
    }

    /**
     * @param PDOStatement $pdos_delete
     * @return MyPDO
     */
    public function setPdosDelete(PDOStatement $pdos_delete): MyPDO
    {
        $this->pdos_delete = $pdos_delete;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosSelectAll(): PDOStatement
    {
        return $this->pdos_selectAll;
    }

    /**
     * @param PDOStatement $pdos_selectAll
     * @return MyPDO
     */
    public function setPdosSelectAll(PDOStatement $pdos_selectAll): MyPDO
    {
        $this->pdos_selectAll = $pdos_selectAll;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomTable(): string
    {
        return $this->nomTable;
    }

    /**
     * @param string $nomTable
     * @return MyPDO
     */
    public function setNomTable(string $nomTable): MyPDO
    {
        $this->nomTable = $nomTable;
        return $this;
    }
    public function initPDOS_selectAll() {
        $this->pdos_selectAll = $this->pdo->prepare('SELECT DISTINCT * FROM '.$this->nomTable);
    }




    public function getAll(): array {
        if (!isset($this->pdos_selectAll))
            $this->initPDOS_selectAll();
        $this->getPdosSelectAll()->execute();
        return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS,
            "bar\Entite".ucfirst($this->getNomTable()));
    }
    public function initPDOS_select(string $nomColID): void
    {
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE $nomColID = :$nomColID";
        $this->pdos_select = $this->pdo->prepare($requete);
    }
    public function get($key, $val) {
        if (!isset($this->pdos_select))
            $this->initPDOS_select($key);
        $this->getPdosSelect()->bindValue(":".$key,$val);
        $this->getPdosSelect()->execute();
       return $this->getPdosSelect()
                     ->fetchObject("bar\Entite".ucfirst($this->getNomTable()));
   }

   public function initPDOS_update(string $nomColId, array $colNames): void {
    $query = "UPDATE ".$this->nomTable." SET ";
    foreach ($colNames as $colName) {
        $query .= $colName."=:".$colName.", ";
    }
    $query = substr($query,0, strlen($query)-2);
    $query .= " WHERE ".$nomColId."=:".$nomColId;
    $this->pdos_update =  $this->pdo->prepare($query);
}


public function update(string $id, array $assoc): void {
    if (! isset($this->pdos_update))
        $this->initPDOS_update($id, array_keys($assoc));
    foreach ($assoc as $key => $value) {
        $this->getPdosUpdate()->bindValue(":".$key, $value);
    }
    $this->getPdosUpdate()->execute();
}

public function initPDOS_insert(array $colNames): void {
    $query = "INSERT INTO ".$this->nomTable." VALUES(";
    foreach ($colNames as $colName) {
        $query .= ":".$colName.",";
    }
    $query = substr($query,0, strlen($query)-2);
    $query .= ')';
    echo $query;
    $this->pdos_insert = $this->pdo->prepare($query);
}
public function insert(array $assoc): void {
    if (! isset($this->pdos_insert))
        $this->initPDOS_insert(array_keys($assoc));
    foreach ($assoc as $key => $value) {
        $this->getPdosInsert()->bindValue(":".$key, $value);
    }
    $this->getPdosInsert()->execute();
}

public function initPDOS_delete(string $nomColId): void {
    $this->pdos_delete = $this->pdo->prepare("DELETE FROM ". $this->nomTable
                                                  ." WHERE $nomColId=:".$nomColId);
}


public function delete(array $assoc) {
    if (! isset($this->pdos_delete))
        $this->initPDOS_delete(array_keys($assoc)[0]);
    foreach ($assoc as $key => $value) {
        $this->getPdosDelete()->bindValue(":".$key, $value);
    }
    $this->getPdosDelete()->execute();
}
public function initPDOS_count() {
    $this->pdos_count = $this->pdo->prepare("SELECT COUNT(*) FROM ".$this->nomTable);

}

public function count() {
  if (! isset($this->pdos_count))
    $this->initPDOS_count();

     $this->getPdosCount()->execute();

}
public function getCountValue() : int {
    $this->count();
    return $this->pdos_count->fetch(PDO::FETCH_NUM)[0];
  }
  public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function getPdosSelect() : PDOStatement
    {
        return $this->pdos_select;
    }



    public function getPdosSelectAll(): PDOStatement
    {
        return $this->pdos_selectAll;
    }

    /**
     * @param PDOStatement $pdos_select
     * @return MyPDO
     */
    public function setPdosSelect(PDOStatement $pdos_select): MyPDO
    {
        $this->pdos_select = $pdos_select;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosUpdate(): PDOStatement
    {
        return $this->pdos_update;
    }

    /**
     * @param PDOStatement $pdos_update
     * @return MyPDO
     */
    public function setPdosUpdate(PDOStatement $pdos_update): MyPDO
    {
        $this->pdos_update = $pdos_update;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosInsert(): PDOStatement
    {
        return $this->pdos_insert;
    }

    /**
     * @param PDOStatement $pdos_insert
     * @return MyPDO
     */
    public function setPdosInsert(PDOStatement $pdos_insert): MyPDO
    {
        $this->pdos_insert = $pdos_insert;
        return $this;
    }

    /**
     * @return PDOStatement
     */
    public function getPdosDelete(): PDOStatement
    {
        return $this->pdos_delete;
    }

    /**
     * @param PDOStatement $pdos_delete
     * @return MyPDO
     */
    public function setPdosDelete(PDOStatement $pdos_delete): MyPDO
    {
        $this->pdos_delete = $pdos_delete;
        return $this;
    }

    

    public function getPdosCount(): PDOStatement
    {
        return $this->pdos_count;
    }

    /**
     * @return string
     */
    public function getNomTable(): string
    {
        return $this->nomTable;
    }

    /**
     * @param string $nomTable
     * @return MyPDO
     */
    public function setNomTable(string $nomTable): MyPDO
    {
        $this->nomTable = $nomTable;
        return $this;
    }

}

?>