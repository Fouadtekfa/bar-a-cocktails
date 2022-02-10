<?php

class MyPDO {
    private PDO $pdo;
    private PDOStatement $pdos_select;
    private PDOStatement $pdos_update;
    private PDOStatement $pdos_insert;
    private PDOStatement $pdos_delete;
    private PDOStatement $pdos_selectAll;
    private string $nomTable;

    public function __construct($sgbd, $host, $db, $user, $password, $nomTable) {
        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$db, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>