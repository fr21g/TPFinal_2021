<?php

include_once("../../configuracion.php");
$session=new Session();

if($session->cerrar()){
 header('location:../paginas/login.php');

}else{
    header('location:../paginas/paginaSegura.php');
    echo "No se pudo cerrar sesion";
}


?>