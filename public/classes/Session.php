<?php

session_start();

if(!isset($_GET['action']))
    $_GET['action'] = 'init';

$myPDO = new MyPDO($_ENV['sgbd'], $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['pwd']);
/*$myPDO->setNomTable('Etape');
echo 'hola';
$myPDO->initPDOS_selectAll();
$va =  $myPDO->getAll();

foreach ($va as $valeur){
    echo $valeur->getCNom();
}*/
