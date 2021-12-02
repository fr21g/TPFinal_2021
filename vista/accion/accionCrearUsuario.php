<?php 
include_once '../../configuracion.php';

$datos = data_submitted();
$objAdmin = new Abmadmin();

if($objAdmin->crearUsuario($datos)){
    header('Location: ../paginas/gestionarUsuarios.php?rol=administrador');
}else{
    header('Location: ../paginas/gestionarUsuarios.php?rol=administrador');
}

?>