<?php
include_once('../../configuracion.php');
$objItem = new Abmcompraitem();
$datos = data_submitted();
$filtro = [];
$filtro['idcompraitem'] = $datos['idcompraitem'];
if($objItem->baja($filtro)){
    header("Location: ../paginas/carrito.php?rol=cliente");
}else{
    header("Location: ../paginas/carrito.php?rol=cliente");
}

?>