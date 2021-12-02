<?php
include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');


if($session->activa() && $datouser['rol'] == "administrador"){
?>



<!-- Crear usuario -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">

                    <h2>Datos del nuevo usuario</h2>
                    <p>Ingrese los datos por favor.</p>

                    <form id="form" name="form" data-toggle="validator"  method="post"  action="../accion/accionCrearUsuario.php?rol=administrador">

                        <div class="row">
                        <!-- nombre de usuario -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Nombre Usuario" required data-error="Por favor ingrese nombre del nuevo usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <!-- Contraseña -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="uspass" id="uspass" type="password" placeholder="Contraseña"  class="form-control"  minlength="5"  required data-error="Por favor ingrese una contraseña">
                                    <div class="help-block with-errors"></div>
                                    <div class="row  mb-3 text-danger"  style="text-align: center;">
                                    
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- mail -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usmail" name="usmail" placeholder="mail@mail.com" required data-error="Por favor ingrese un mail valido">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <!-- Seleccion de rol -->    
                            <div class="col-md-12">
                                <hr class="mb-4">

                                <p>Selecione rol:</p>
                                
                                <div class="form-check form-switch">
                                    <input name = "idrol[]" value="1" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Administrador</label>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input name = "idrol[]" value="2"class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Deposito</label>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input name ="idrol[]" value="3" class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled">
                                    <label class="form-check-label" >Cliente</label>
                                </div>
                                <hr class="mb-4">
                            </div>

                            <!-- Boton enviar -->
                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Agregar Usuario</button>
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
include_once('../estructura/pie.php');
?>