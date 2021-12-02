<?php
//include_once('../../control/CrearCarrito.php');
include_once('../../configuracion.php');

$objCarrito = new CrearCarrito();
$datos = data_submitted();
$filtro = [];
$filtro['idproducto'] = $datos['idproducto'];

if($objCarrito->aniadirCarrito($filtro)){
    echo "si";header("Location: ../paginas/carrito.php?rol=cliente");
}else{
    echo "no";
    header("Location: ../paginas/carrito.php?rol=cliente");
}




?>