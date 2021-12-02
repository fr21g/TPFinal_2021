<?php
include_once('../../configuracion.php');
$datos= data_submitted();
$objDeposito = new Abmdeposito();

if($objDeposito->modicarProducto($datos)){
    header('location: ../paginas/productosDeposito.php?rol=deposito');
    //echo "si!!";
}else{
    header('location: ../paginas/productosDeposito.php?rol=deposito');
    //echo "no!!";
}

include_once('../estructura/pie.php');
?>