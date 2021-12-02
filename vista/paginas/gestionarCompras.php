<?php
include_once('../estructura/cabeceraNueva.php');
$objCompraEstado = new ABMCompraestado();
$arreglo = $objCompraEstado->buscar(null);
$rolesUs = $session->getRol();
$error=false;
foreach($rolesUs as $r){
    if($r == "administrador"){
if($session->activa() && $datouser['rol'] == "administrador"){
?>


    <!-- Start All Title Box -->
    <!-- <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"> 
                    <h2>Gestionar Compras</h2>
                </div>
            </div>
        </div>
    </div>  -->
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <?php

            $datos = data_submitted();
            if(isset($datos['true'])){
                echo "<span class='text-success border border-success'>exito se elimino correctamente!</span>";
            }
            if(isset($datos['false'])){
                echo "<span class='text-danger border border-danger'>No se pudo eliminar item!</span>";
            }
            
            if(isset($datos['modifytrue'])){
                echo "<span class='text-success border border-success'>Modificado Correctamente.</span>";
            }
            if(isset($datos['modifyfalse'])){
                echo "<span class='text-danger border border-danger'>No Modificado! no ha cambiado los kg que desea comprar.</span>";
            }
            
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                    <h2>Gestionar Compras</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Estado de Compra</th>
                                    <th>ID Compra</th>
                                    <th>Estado</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Fin</th>
                                    <th>Aceptar y Enviar</th>
                                    <th>Cancelar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mostrar= false;
                                if(count($arreglo)>0){
                                    foreach ($arreglo as $item){
                                
                                ?>
                                <form method="post" action="../accion/editarItemCarrito.php">
                                    <tr>
                                        <td class="thumbnail-img " name="idcompraestado">
                                            <?php echo $item->getIdCompraEstado();?>
                                        </td>
                                        <td class="thumbnail-img ">
                                            <?php echo $item->getObjcompra()->getIdCompra() ?>
                                        </td>
                                        <td class="name-pr ">
                                            <?php echo $item->getObjCompraEstadoTipo()->getcetdetalle()?>
                                        </td>
                                        <td class="price-pr">
                                            <?php echo $item->getCefechaini();?>
                                        </td>
                                        <td class="quantity-box ">
                                        <?php echo $item->getCefechafin();?>
                                        </td>
                                        <td class="remove-pr update-box">
                                            <a name="idcompraestado" href="../accion/aceptaEnviarPedido.php?php echo $item->getIdCompraEstado()?>" ><i class="fas fa-check-square"></i></i></a>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/cancelarCompra.php?idcompraitem=<?php echo $item->getIdCompraEstado()?>" ><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                                $mostrar= true;
                                    }
                                }
                                if(!$mostrar){?>
                                    <td class="thumbnail-img">
                                        <?php echo "no hay compras";?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$error=true;
}
}
}
if(!$error){
    echo '<div class="alert alert-danger" role="alert">Acceso Denegado</div>';
}
?>

    <!-- End Cart -->

<?php
include_once('../estructura/pie.php');
?>
