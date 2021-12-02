<?php
/*include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');
$objRol = new ABMRol();
$datos = data_submitted();
$idRol['idrol'] = $datos["idrol"];
$roles = $objRol->buscar($idRol);
if($session->activa() && $datouser['rol'] == "administrador"){

foreach($roles as $rol){
    $rolDesc = $rol->getRodescript();
}
?>
<!-- Editar Rol -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">

                    <h2>Datos del nuevo Rol</h2>
                    <p>Ingrese los datos por favor.</p>

                    <form id="form" name="form" data-toggle="validator"  method="post"  action="../accion/accionEditarRol.php">

                        <div class="row">
                        <!-- nombre de Rol -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="rodescripcion" name="rodescripcion" value="<?php echo $rolDesc; ?>"  required data-error="Por favor ingrese nombre del nuevo usuario">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <!-- Boton enviar -->
                            <div class="col-md-12">
                                <div class="col py-3 px-lg-5  ">
                                <button class="btn btn-primary" type="submit">Editar Rol</button>
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
?>*/