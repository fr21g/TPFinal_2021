<?php
include_once('../../configuracion.php');

$datos = data_submitted();
$objAdmin = new Abmadmin();

if($objAdmin->crearMenu($datos)){
    //echo "si!";
    header('Location: ../paginas/gestionarMenu.php?rol=administrador');
}else{
    //echo "no!";
    header('Location: ../paginas/gestionarMenu.php?rol=administrador');
}



?>