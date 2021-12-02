<?php
include_once('../../configuracion.php');

$datos= data_submitted();
$objAdmin = new Abmadmin();

if($objAdmin->modificarMenu($datos)){
    //echo '<div class="alert alert-success" role="alert">Datos modificados con exito</div>';
    header('location: ../paginas/gestionarMenu.php?rol=administrador');
}else{
    //echo '<div class="alert alert-danger" role="alert">No se pudieron actualizar los datos</div>';
    header('location: ../paginas/gestionarMenu.php?rol=administrador');
}

?>
