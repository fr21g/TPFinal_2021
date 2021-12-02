<?php
include_once('../../configuracion.php');

$objAdmin= new Abmadmin();
$datos = data_submitted();

if($objAdmin->crearRol($datos)){
    header('Location: ../paginas/gestionRoles.php?rol=administrador');
}else{
    header('Location: ../paginas/gestionRoles.php?rol=administrador');
}


?>