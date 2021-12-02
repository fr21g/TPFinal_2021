<?php
include_once('../../configuracion.php');

$objAdmin= new Abmadmin();
$datos= data_submitted();

if($objAdmin->habilitarMenu($datos)){
    header('location: ../paginas/gestionarMenu.php?rol=administrador');
}else{
    header('location: ../paginas/gestionarMenu.php?rol=administrador');
}

?>