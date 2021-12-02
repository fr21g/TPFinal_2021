<?php
include_once('../estructura/cabeceraNueva.php');
include_once('../../configuracion.php');

$objUsuario=new ABMUsuario();

$arreglo=$objUsuario->buscar(null);
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
                    <h2>Usuarios</h2>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="contasiner">
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
            <div class="">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                    <h2>Gestionar Usuarios</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Usuario</th>
                                    <th>Nombre</th>
                                    <th>contraseña</th>
                                    <th>Mail</th>
                                    <th>Roles</th>
                                    <th>Deshabilitado:</th>
                                    <th>Modificar</th>
                                    <th>Habilitar</th>
                                    <th>Deshabilitar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($arreglo as $usuario){
                                        $idu = $usuario->getIdusuario();
                                ?>
                                <form method="post" action="../accion/modificarUsuarios.php?rol=administrador">
                                    <tr>
                                        <td class="thumbnail-img remove-pr" name="idcompraitem">
                                            <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario();?>"> 
                                            <?php echo $usuario->getIdusuario();?>
                                        </td>
                                        <td class="thumbnail-img remove-pr">
                                            <input type="text" name="usnombre" value="<?php echo $usuario->getUsnombre();?>">
                                        </td>
                                        <td class="name-pr remove-pr">
                                            <input type="password" name="uspass" value="">
                                        </td>
                                        <td class="quantity-box ">
                                        <input type="text" name="usmail" value="<?php echo $usuario->getUsmail(); ?>">
                                        </td>
                                        <td class="total-pr remove-pr">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <?php
                                            $abmrol=new ABMRol();
                                            $abmUsuarioRol= new ABMUsuariorol();
                                            $array = ["idusuario"=>$idu];
                                            $listaUsuarioRol=$abmUsuarioRol->buscar($array);
                                            $listaRol= $abmrol->buscar(null);
                                            $checked="";
                                            foreach($listaRol as $descriptRol){
                                            $checked="";
                                                
                                                foreach($listaUsuarioRol as $usuarioRol){
                                                    if($descriptRol->getRodescript()==$usuarioRol->getObj_rol()->getRodescript()){
                                                                $checked="checked";
                                                    }
                                                
                                                }
                                            
                                            
                                            if($descriptRol->getRodescript()!="publico"){
                                            echo '<input class=""  id="rol" name="listarol[]" type="checkbox" value="'.$descriptRol->getIdRol().'" '.$checked.'>
                                            '.$descriptRol->getRodescript().'</input><br>';
                                            }
                                            }
                                            ?>
                                        </div>
                                        </div>
                                        
                                        </td>
                                        <td class="total-pr remove-pr">
                                        <input type="hidden" name="medeshabilitado" value="<?php echo $usuario->getUsdeshabilitado();?>">
                                        <?php echo $usuario->getUsdeshabilitado();?>
                                        </td>
                                        <td class="remove-pr update-box">
                                        <button class="border-0 bg-white" type="submit" value=""><i class='fas fa-edit'></i></button>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/habilitarUsuario.php?idusuario=<?php echo $usuario->getIdusuario();?>" ><i class="fas fa-check"></i></a>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/deshabilitarUsuario.php?idusuario=<?php echo $usuario->getIdusuario();?>" ><i class="fas fa-ban"></i></a>
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
                            <form method="post" action="crearUsuario.php?rol=administrador">
                                <div class="update-box">
                                    <input value="Crear Usuario" type="submit">
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