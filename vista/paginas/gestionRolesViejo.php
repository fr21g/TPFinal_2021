<?php
include_once('../estructura/cabeceraNueva.php');
include_once('../../configuracion.php');
$objRol = new ABMRol();

$arreglo=$objRol->buscar(null);
$rolesUs = $session->getRol();
$error=false;
foreach($rolesUs as $r){
    if($r == "administrador"){
if($session->activa() && $datouser['rol'] == "administrador"){

?>

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
                <div class="">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Rol</th>
                                    <th>Rol</th>
                                    <th>Editar Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mostrar = false;
                                if(count($arreglo)>0){
                                    foreach ($arreglo as $rol){

                                ?>
                                <form method="post" action="../accion/accionEditarRol.php?rol=administrador">
                                    <tr>
                                        <td class="thumbnail-img remove-pr" name="idcompraitem">
                                            <input type="hidden" name="idrol" value="<?php echo $rol->getIdrol();?>">
                                            <?php echo $rol->getIdrol();?>
                                        </td>
                                        <td class="thumbnail-img remove-pr">
                                            
                                            <input type ="text" name="rodescripcion" value="<?php echo $rol->getRodescript();?>">
                                        </td>
                                        <td class="remove-pr ">
                                            <button class="border-0 bg-white" type="submit" value=""><i class='fas fa-edit'></i></button>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                    }
                                    $mostrar= true;
                                }
                                if(!$mostrar){?>
                                    <td class="thumbnail-img">
                                        <?php echo "no hay Items en el carrito";?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <?php
                    
                    ?>
                    <div class="row my-5">
                        <div class="col-lg-6 col-sm-6"></div>
                        <div class="col-lg-6 col-sm-6">
                            <form method="post" action="crearRol.php?rol=administrador">
                                <div class="update-box">
                                    <input value="Crear Rol" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    
                    ?>
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