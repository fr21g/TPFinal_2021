<?php
include_once("../../configuracion.php");
include_once("../estructura/cabeceraNueva.php");

if($session->activa() && $datouser['rol'] == "administrador"){
?>

<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>EDITAR USUARIO</h2>
                    <p>Edite sus datos por favor.</p>
                    <form id="contassctForm" name="contasctForm" data-toggle="validator"  method="post"  action="../accion/loginActualizacion.php">
                        <div class="row">
                            <div class="col-md-12" style="display:none;">
                                <div class="form-group">
                                    ID
                                    <input id="idusuario" readonly name ="idusuario" class="form-control" type="text" value="<?php echo $session->getUsuario()->getIdusuario();?>">
                                    <?php ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Nombre de Usuario:
                                    <input type="text" class="form-control" id="usnombre" name="usnombre" value="<?php echo $session->getUsuario()->getUsnombre();?>" required data-error="Por favor ingrese su usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Contraseña Nueva:
                                    <input type="password" value="" id="uspass" class="form-control" name="uspass" minlength="5"  required data-error="Por favor ingrese su contraseña">
                                    <div class="help-block with-errors"></div>
                                    <div class="row  mb-3 text-danger"  style="text-align: center;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Email:
                                    <input type="text" class="form-control" id="usmail" name="usmail" value="<?php echo $session->getUsuario()->getUsmail(); ?>" required data-error="Por favor ingrese su usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    ROLES<br>
                                    <?php
                                    $abmrol=new ABMRol();
                                    $abmUsuarioRol= new ABMUsuariorol();
                                    $array = ["idusuario"=>$session->getUsuario()->getIdusuario()];
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
                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Guardar Cambios</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Acceso Denegado</div>';
}
?>




<?php

include_once("../estructura/pie.php");

?>