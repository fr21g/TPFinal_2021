<?php
include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');
if($session->activa() && $datouser['rol'] == "administrador"){

?>
<!-- Formulario Nuevo producto  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>Nuevo Menu</h2>
                    <p>Ingrese datos</p>
                    <form id="nuevomenu" name="nuevomenu" data-toggle="validator"  method="post" enctype="multipart/form-data"  action="../accion/accionCrearMenu.php?rol=administrador">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="menombre" name="menombre" placeholder="Nombre de Menu" required data-error="ingrese nombre de menu">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="medescripcion" name="medescripcion" placeholder="Descripcion" value="Aun sin definir" required data-error="ingrese descripcion de menu">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!--<div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="idpadre" name="idpadre"  required data-error="ingrese id de padre">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>-->
                            
                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Agregar Menu</button>
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