<?php
include "connexion.php";
class MyPDO {
    private $pdo;
    private $pdos_selectAll;
    private $pdos_select;
    private $pdos_update;
    private $pdos_insert;
    private $pdos_delete;
    private $pdos_count;
    private $nomTable;

    public function __construct($sgbd, $host, $db, $user, $password, $nomTable)
    {
        switch ($sgbd) {
            case "mysql":
                $this->pdo = new PDO("mysql:host=".$host.";dbname=".$db, $user, $password);
                break;
            case "pgsql":
                $this->pdo = new PDO("pgsql:host=".$host." dbname=".$db." user=".$user." password=".$password);
                break;
            default:
                exit;
        }

        // pour récupérer aussi les exceptions provenant de PDOStatement
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->nomTable = $nomTable;

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
    public function initPDOS_select(string $nomColID  = "code"): void
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
                     ->fetchObject("lmsf\Entite".ucfirst($this->getNomTable()));
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

}

?>