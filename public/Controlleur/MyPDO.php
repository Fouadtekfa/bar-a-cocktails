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


}

?>