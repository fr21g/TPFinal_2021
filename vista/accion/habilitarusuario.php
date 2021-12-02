<?php
include_once('../../configuracion.php');
$datos= data_submitted();
$objAdmin = new Abmadmin();

if($objAdmin->habilitarUsuario($datos)){
    header('location: ../paginas/gestionarUsuarios.php?rol=administrador');
}else{
    header('location: ../paginas/gestionarUsuarios.php?rol=administrador');
}

?>