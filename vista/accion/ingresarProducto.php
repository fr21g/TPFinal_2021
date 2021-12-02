<?php
include_once('../../configuracion.php');

$datos= data_submitted();
$objDeposito = new Abmdeposito();
$abmproducto = new Abmproducto();

$file=$_FILES['imagen'];
$filename=$file['name'];
$extension = pathinfo($filename, PATHINFO_EXTENSION);
$ext=".".$extension;

if($objDeposito->ingresarProducto($datos)){
    $buscar = $abmproducto ->buscar($datos);
    if(!empty($buscar)){
        $directorio = "../../uploads/";
        $md5 = md5($buscar[0]->getIdproducto());
        copy($file['tmp_name'], $directorio.$md5.$ext);

        //echo '<div class="alert alert-success" role="alert">Producto ingresado al catálogo</div>';
        header('location: ../paginas/productosDeposito.php?rol=deposito');
    }
}else{
    //echo '<div class="alert alert-danger" role="alert">El producto ya se encuentra en el catálogo</div>';
    header('location: ../paginas/productosDeposito.php?rol=deposito');
}


include_once('../estructura/pie.php');
?>