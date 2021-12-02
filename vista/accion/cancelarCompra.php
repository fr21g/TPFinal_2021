<?php 
include_once('../../configuracion.php');
$objAdmin = new Abmadmin();
$datos = data_submitted();

if($objAdmin->cancelarPedido($datos)){
    header("Location: ../paginas/gestionarCompras.php?rol=administrador");
}else{
    header("Location: ../paginas/gestionarCompras.php?rol=administrador");
}

?>