<?php

session_start();

if(!isset($_GET['action']))
    $_GET['action'] = 'init';

$myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);
$myPDO->setNomTable('g07_etape');
echo 'hola';
$myPDO->initPDOS_selectAll();
echo $myPDO->getAll();

