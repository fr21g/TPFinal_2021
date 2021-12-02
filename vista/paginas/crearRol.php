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

                    <h2>Nuevo Rol</h2>
                    <p>Ingrese el nuevo rol por favor.</p>

                    <form id="form" name="form" data-toggle="validator"  method="post"  action="../accion/accionCrearRol.php">

                        <div class="row">
                        <!-- nombre de Rol -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="rodescripcion" name="rodescripcion" placeholder="Nombre Rol"  required data-error="Por favor ingrese nombre del nuevo usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
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