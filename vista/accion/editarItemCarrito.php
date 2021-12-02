<?php
include_once('../../configuracion.php');

$objCarrito = new CrearCarrito();
$datos = data_submitted();

if($objCarrito->editarCantProducto($datos)){
    header("Location: ../paginas/carrito.php?rol=cliente");
}else{
    header("Location: ../paginas/carrito.php?rol=cliente");
}


?>