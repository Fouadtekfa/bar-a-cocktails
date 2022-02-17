<?php
require_once "Controlleur/MyPDO.php";
require_once "Controlleur/connexion.php";
$_ENV['myPdo'] = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);