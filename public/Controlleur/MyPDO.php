<?php

class MyPDO {
    private PDO $pdo;
    private PDOStatement $pdos_select;
    private PDOStatement $pdos_update;
    private PDOStatement $pdos_updateRelation;
    private PDOStatement $pdos_insert;
    private PDOStatement $pdos_delete;
    private PDOStatement $pdos_selectAll;
    private PDOStatement $pdos_selectAllById;
    private string $nomTable;

    public function __construct($sgbd, $host, $db, $user, $password, $table='null'){
        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$db, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->setNomTable($table);
    }

    public function initPDOS_selectAll() {
        $this->pdos_selectAll = $this->pdo->prepare('SELECT * FROM '.$this->nomTable);
    }

    public function initPDOS_selectAllById($nomId, $valeur) {
        $query = 'SELECT * FROM '
        .$this->nomTable . ' WHERE '. $nomId.' = '. $valeur;
        $this->pdos_selectAllById = $this->pdo->prepare($query);
        //echo "mira" . $query;
    }

    public function getAll(): array {
        if (!isset($this->pdos_selectAll))
            $this->initPDOS_selectAll();
        $this->getPdosSelectAll()->execute();
        return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS,
            "bar\Entite".ucfirst($this->getNomTable()));
    }

    public function getAllById($nomId, $valeur): array
    {
        if (!isset($this->pdos_selectAll))
            $this->initPDOS_selectAllById($nomId, $valeur);
        $this->getPdosSelectAll()->execute();
        return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS,
            "bar\Entite".ucfirst($this->getNomTable()));
    }

    public function getSpecific($nomId, $valeur): array {
        if (!isset($this->pdos_selectAllById)){
            $this->initPDOS_selectAllById($nomId, $valeur);
            
        }
        
        $this->getPdosSelectAllById()->execute();
        return $this->getPdosSelectAllById()->fetchAll(PDO::FETCH_CLASS,
            "bar\Entite".ucfirst($this->getNomTable()));
    }

    public function initPDOS_select(string $nomColID = "id"): void
    {
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE $nomColID = :$nomColID";
        $this->pdos_select = $this->pdo->prepare($requete);
    }

    public function initPDOS_selectById(string $nomColID = "id", $val): void
    {
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE $nomColID = :$nomColID";
        $this->pdos_select = $this->pdo->prepare($requete);
    }

    public function initPDOS_selectBy2Keys(string $nomColID1 = "id", string $nomColID2): void
    {
        $requete = "SELECT * FROM ".$this->nomTable ." WHERE $nomColID1 = :$nomColID1" . " AND $nomColID2 = :$nomColID2";
       // echo $requete;
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

    // Obtenir un element d'un
    public function getElement2Keys($key1, $key2, $val1, $val2) {
        if (!isset($this->pdos_select))
            $this->initPDOS_selectBy2Keys($key1, $key2);
        $this->getPdosSelect()->bindValue(":".$key1, $val1);
        $this->getPdosSelect()->bindValue(":".$key2, $val2);
        $this->getPdosSelect()->execute();
        return $this->getPdosSelect()
            ->fetchObject("bar\Entite".ucfirst($this->getNomTable()));
    }

    public function getById($key, $val) {
        if (!isset($this->pdos_select))
            $this->initPDOS_selectById($key, $val);
        $this->getPdosSelect()->bindValue(":".$key,$val);
        $this->getPdosSelect()->execute();
        return $this->getPdosSelect()
            ->fetchObject("bar\Entite".ucfirst($this->getNomTable()));
    }


    /**
     * execute de la requête SELECT COUNT(*)
     * instantiation de self::$_pdos_count
     */
    public function count() {
        if (!isset($this->pdos_count)) {
            $this->initPDOS_count();
        }
        return $this->pdos_count->execute();
    }

    public function getCountValue() : int {
        $this->count();
        return $this->pdos_count->fetch(PDO::FETCH_NUM)[0];
    }

    /**
     * préparation de la requête SELECT COUNT(*)
     * instantiation de self::$_pdos_count
     */
    public function initPDOS_count() {
        $this->pdos_count = $this->pdo->prepare('SELECT COUNT(*) FROM '.$this->nomTable);
    
    }

    /**
     * execute de la requête SELECT MAX(*)
     * instantiation de self::$_pdos_count
     */
    public function max($id) {
        if (!isset($this->pdos_max)) {
            $this->initPDOS_max($id);
        }
        return $this->pdos_max->execute();
    }

    public function getIdMax($id) : int {
        $this->max($id);
        return $this->pdos_max->fetch(PDO::FETCH_NUM)[0];
    }

    public function getIdMaxENumFromCocktail($id, $cocktailId) : int {
        $this->max($id, $cocktailId);
        return $this->pdos_max->fetch(PDO::FETCH_NUM)[0];
    }

    public function maxWithCocktailId($id, $cocktailId) {
        if (!isset($this->pdos_max)) {
            $this->initPDOS_max_cocktailId($id, $cocktailId);
        }
        return $this->pdos_max->execute();
    }

    public function initPDOS_max_cocktailId($id, $cocktailId) {
        $this->pdos_max = $this->pdo->prepare('SELECT MAX('.$id.') FROM '.$this->nomTable. 'WHERE c_id = '. $cocktailId);
    }

    /**
     * préparation de la requête SELECT MAX(*)
     * instantiation de self::$_pdos_count
     */
    public function initPDOS_max($id) {
        $this->pdos_max = $this->pdo->prepare('SELECT MAX('.$id.') FROM '.$this->nomTable);
    }

    /**
     * @param array $assoc
     */
    public function insert(array $assoc): void
    {
        if (!isset($this->pdos_insert))
            $this->initPDOS_insert(array_keys($assoc));
        foreach ($assoc as $key => $value) {
            $this->getPdosInsert()->bindValue(":" . $key, $value);
        }
        $this->getPdosInsert()->execute();
    }

     /**
     * @param array
     */
    public function initPDOS_insert(array $colNames): void
    {
        $query = "INSERT INTO " . $this->nomTable . " VALUES(";
        foreach ($colNames as $colName) {
            $query .= ":" . $colName . ", ";
        }
        $query = substr($query, 0, strlen($query) - 2);
        $query .= ')';
        $this->pdos_insert = $this->pdo->prepare($query);
    }

    /**
     * @return PDOStatement
     */
    public function getPdosInsert(): PDOStatement
    {
        return $this->pdos_insert;
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
     * @return PDOStatement
     */
    public function getPdosUpdateRelation(): PDOStatement
    {
        return $this->pdos_updateRelation;
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
     * @return PDOStatement
     */
    public function getPdosSelectAllById(): PDOStatement
    {
        return $this->pdos_selectAllById;
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

     /**
     * @param string $id
     * @param array $assoc
     */
    public function update(string $id, array $assoc): void {
       if (!isset($this->pdos_update)){
        $this->initPDOS_update($id, array_keys($assoc));
       }
        foreach ($assoc as $key => $value) {
            $this->getPdosUpdate()->bindValue(":".$key, $value);
        }
        $this->getPdosUpdate()->execute();
    }


      /**
     * @param string $nomColId
     * @param array $colNames
     */
    public function initPDOS_update(string $nomColId, array $colNames): void {
        $query = "UPDATE ".$this->nomTable." SET ";
        foreach ($colNames as $colName) {
            $query .= $colName."=:".$colName.", ";
        }
        $query = substr($query,0, strlen($query)-2);
        $query .= " WHERE ".$nomColId."=:".$nomColId;
        $this->pdos_update =  $this->pdo->prepare($query);
    }

      /**
     * @param string $id
     * @param array $assoc
     */
    public function updateRelation(string $id, string $id_2, array $assoc): void {
        if (!isset($this->pdos_updateRelation)){
         $this->initPDOS_updateRelation($id, $id_2, array_keys($assoc));
        }
         foreach ($assoc as $key => $value) {
             $this->getPdosUpdateRelation()->bindValue(":".$key, $value);
         }
         $this->getPdosUpdateRelation()->execute();
     }

       /**
     * @param string $nomColId
     * @param array $colNames
     */
    public function initPDOS_updateRelation(string $nomColId, string $nomColId2, array $colNames): void {
        $query = "UPDATE ".$this->nomTable." SET ";
        foreach ($colNames as $colName) {
            $query .= $colName."=:".$colName.", ";
        }
        $query = substr($query,0, strlen($query)-2);
        $query .= " WHERE ".$nomColId."=:".$nomColId. " AND  ".$nomColId2."=:".$nomColId2;
       // echo $query;
        $this->pdos_updateRelation =  $this->pdo->prepare($query);
    }

     /**
     * @param array $assoc
     */
    public function delete(array $assoc) {
        try {
            if (! isset($this->pdos_delete)) {
                $keys = array_keys($assoc);
                if(count($keys) == 1)
                    $this->initPDOS_delete($keys[0]);
                else
                    $this->initPDOS_delete($keys[0],$keys[1]);
            }
            foreach ($assoc as $key => $value) {
                $this->getPdosDelete()->bindValue(":".$key, $value);
            }
            $this->getPdosDelete()->execute();
        } catch (Exception $e) {
            $_SESSION['message'] = "Erreur: ".$e->getMessage();
        }
    }

     /**
     * @param string
     */

    public function initPDOS_delete(string $nomColId = "id"): void {
        $statement = "DELETE FROM ". $this->nomTable." WHERE $nomColId=:".$nomColId;
        $this->pdos_delete = $this->pdo->prepare($statement);
    }
}

?>