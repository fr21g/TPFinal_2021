<?php
include_once('../../configuracion.php');
include_once('../estructura/cabeceraNueva.php');
$rolesUs = $session->getRol();
$error=false;
foreach($rolesUs as $r){
    if($r == "deposito"){
if($session->activa() && $datouser['rol'] == "deposito"){

?>
<!-- Formulario Nuevo producto  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>Nuevo Producto</h2>
                    <p>Ingrese datos</p>
                    <form id="nuevoproducto" name="nuevoproducto" data-toggle="validator"  method="post" enctype="multipart/form-data"  action="../accion/ingresarProducto.php?rol=deposito">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pronombre" name="pronombre" placeholder="Nombre de producto" required data-error="ingrese nombre de producto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="prodetalle" name="prodetalle" placeholder="Detalle del producto" required data-error="ingrese nombre de producto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Cantidad" id="procantstock" class="form-control" name="procantstock" minlength="1"  required data-error="ingrese cantidad">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" required data-error="ingrese precio">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                <input type="file" class ="form-control" name="imagen" id="imagen"  required>
                                <div class="help-block with-errors"></div>
                                </div>
                                <img id="img1" ><br/>
                            </div>
                            <script>

                                function init() {
                                var inputFile = document.getElementById('imagen');
                                inputFile.addEventListener('change', mostrarImagen, false);
                                }

                                function mostrarImagen(event) {
                                var file = event.target.files[0];
                                var reader = new FileReader();
                                reader.onload = function(event) {
                                    var img = document.getElementById('img1');
                                    img.src= event.target.result;
                                }
                                reader.readAsDataURL(file);
                                }

                                window.addEventListener('load', init, false);

                            </script>

                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Agregar producto</button>
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
$error=true;
}
}
}
if(!$error){
    echo '<div class="alert alert-danger" role="alert">Acceso Denegado</div>';
}
?>







<?php
include_once('../estructura/pie.php');
?>