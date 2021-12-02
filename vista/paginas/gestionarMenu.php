<?php
include_once('../estructura/cabeceraNueva.php');
include_once('../../configuracion.php');

$objMenu=new ABMMenu();

$arreglo=$objMenu->buscar(null);
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
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
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
                    <h2>Gestionar Menu</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Menu</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>ID Padre</th>
                                    <th>Deshabilitado</th>
                                    <th>Editar Menu</th>
                                    <th>Habilitar</th>
                                    <th>Deshabilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($arreglo as $menu){

                                ?>
                                <form method="post" action="../accion/accionEditarMenu.php?rol=administrador">
                                    <tr>
                                        <td class="thumbnail-img remove-pr" name="idcompraitem">
                                            <input type="hidden" name="idmenu" value="<?php echo $menu->getIdmenu();?>"> 
                                            <?php echo $menu->getIdmenu();?>
                                        </td>
                                        <td class="thumbnail-img remove-pr">
                                            <input type="text" name="menombre" value="<?php echo $menu->getMenombre();?>">
                                        </td>
                                        <td class="name-pr remove-pr">
                                            <input type="text" name="medescripcion" value="<?php echo $menu->getMedescripcion();?>">
                                        </td>
                                        <td class="quantity-box ">
                                        <input type="number" name="idpadre" value="<?php echo $menu->getIdpadre(); ?>">
                                        </td>
                                        <td class="total-pr remove-pr">
                                        <input type="hidden" name="medeshabilitado" value="<?php echo $menu->getMedeshabilitado();?>">
                                        <?php echo $menu->getMedeshabilitado();?>
                                        </td>
                                        <td class="remove-pr update-box">
                                        <button class="border-0 bg-white" type="submit" value=""><i class='fas fa-edit'></i></button>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/habilitar.php?idmenu=<?php echo $menu->getIdMenu();?>" ><i class="fas fa-check"></i></a>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/deshabilitar.php?idmenu=<?php echo $menu->getIdMenu();?>" ><i class="fas fa-ban"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                                
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
                            <form method="post" action="crearMenu.php?rol=administrador">
                                <div class="update-box">
                                    <input value="Crear Menu" type="submit">
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