<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$session= new Session();
$verificar= $session->iniciar($datos['usnombre'],$datos['uspass']);

if($verificar){
    header('location:../index/index.php?rol=publico');
}else{
    $session->cerrar();
    //$errorsession= "Nombre de usuario y/o password incorrecto";
    header('location:../paginas/login.php?false');
}
include_once("../estructura/cabeceraNueva.php");


include_once("../estructura/pie.php");
?>
