<?php
include_once('../../configuracion.php');

include_once('../estructura/cabeceraNueva.php');

$abmproducto = new Abmproducto();
$datos= data_submitted();
$directorio = "../../uploads/";
$producto=$abmproducto->buscar($datos);
$producto=$producto[0];


?>


<!-- Formulario editar producto  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
            <h2>Editar Producto</h2>
                <div class="contact-form-right">
                    
                    <form id="editarProd" name="editarProd" data-toggle="validator"  method="post" enctype="multipart/form-data"  action="../accion/accionEditarProducto.php">
                        <div class="row">
                        <div class="col-md-12" style="display:none">
                                <div class="form-group">
                                   <b> ID </b>
                                    <input type="text" class="form-control" id="idproducto" name="idproducto" placeholder="id" value="<?php echo $producto->getIdproducto();?>" required data-error="ingrese nombre de producto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>    
                        
                        <div class="col-md-12">
                                <div class="form-group">
                                   <b> Nombre </b>
                                    <input type="text" class="form-control" id="pronombre" name="pronombre" placeholder="Nombre de producto" value="<?php echo $producto->getPronombre();?>" required data-error="ingrese nombre de producto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                   <b> Detalle</b>
                                    <input type="text" class="form-control" id="prodetalle" name="prodetalle" placeholder="Detalle del producto"value="<?php echo $producto->getProdetalle();?>" required data-error="ingrese nombre de producto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <b>Cantidad en Stock</b>
                                    <input type="text" placeholder="Cantidad" id="procantstock" class="form-control" name="procantstock" value="<?php echo $producto->getProcantstock();?>" minlength="1"  required data-error="ingrese cantidad">
                                    <div class="help-block with-errors"></div>
                                                                      
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <b>Precio vigente</b>
                                    <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="<?php echo  $producto->getPrecio();?>"required data-error="ingrese precio">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button">
                                    <button class="btn hvr-hover" id="submit" type="submit">Guardar cambios</button>
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