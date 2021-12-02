<?php
include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');
$datos = data_submitted();
$objCrearCarrito = new CrearCarrito();

if($objCrearCarrito->hacerPedido($datos)){
    echo '<div class="alert alert-success" role="alert">Exito: Gracias por iniciar una compra!</div>';
}else{
    echo '<div class="alert alert-danger" role="alert">Error: Esta compra esta ya fue iniciada</div>';
}


include_once('../estructura/pie.php');
?>
