<?php
include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');
if($session->activa()){
    header("location:../index/index.php");
}




?>
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->


<!-- Start login  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>LOGIN</h2>
                    <p>Ingrese sus datos por favor.</p>
                    <form id="contassctForm" name="contasctForm" data-toggle="validator"  method="post"  action="../accion/verificarLogin.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Nombre Usuario" required data-error="Por favor ingrese su usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" placeholder="Contraseña" id="uspass" class="form-control" name="uspass" minlength="5"  required data-error="Por favor ingrese su contraseña">
                                    <div class="help-block with-errors"></div>
                                    <div class="row  mb-3 text-danger"  style="text-align: center;">
                                    
                                    </div>
                                    <div class="form-group">
                                        <a href="#">Solicitar Cuenta</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Iniciar</button>
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
include_once('../estructura/pie.php');
?>