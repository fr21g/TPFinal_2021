<?php
include_once('../../configuracion.php');

$datos= data_submitted();
print_r($datos);
$abmproducto= new Abmproducto();
if($abmproducto->baja($datos)){
    //echo '<div class="alert alert-success" role="alert">Producto eliminado</div>';
    header('location: ../paginas/productosDeposito.php?rol=deposito');
}else{
    //echo '<div class="alert alert-danger" role="alert">Error al intentar eliminar producto</div>';
    header('location: ../paginas/productosDeposito.php?rol=deposito');
}


?>
<br><a href="#" onClick="history.go(-1)">Volver</a><br>

<?php
include_once('../estructura/pie.php');
?>