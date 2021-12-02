<?php
include_once('../../configuracion.php');

include_once('../estructura/cabeceraNueva.php');
$rolesUs = $session->getRol();
$error=false;
foreach($rolesUs as $r){
    if($r == "deposito"){
if($session->activa() && $datouser['rol'] == "deposito"){
?>

  
   

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    /*$datos = data_submitted();
                    if(isset($datos) == 'rol=deposito'){
                        echo '<div class="alert alert-success" role="alert">Producto ingresado al catálogo</div>';
                    }elseif(!isset($datos) == 'rol'){
                        echo '<div class="alert alert-danger" role="alert">El producto ya se encuentra en el catálogo</div>';
                    }*/
                    ?>
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th>ID Producto</th>
                                    <th>Imagen</th>
                                    <th>Nombre del producto</th>
                                    <th>Precio</th>
                                    <th>kg.</th>
                                    <th>Alta / Baja</th>
                                    <th>Editar</th>
                                    <!-- <th>Eliminar</th> -->
                                </tr>
                            </thead>
                            <tbody>
                               <?php 

                                $abmproducto = new Abmproducto();
                                $datos= data_submitted();
                                $directorio = "../../uploads/";
                                $producto=$abmproducto->buscar($datos);
                                $producto=$producto[0];

                               $abmproducto = new Abmproducto();
                               $productosbd = $abmproducto->buscar(null); //arreglo de objetos producto en la base de datos 
                               $directorio="../../uploads/";
                               foreach ($productosbd as $producto){

                               ?>
                                <form method="post" action="../accion/accionEditarProducto.php?rol=deposito">
                                <tr>
                                    <td class="idproducto">
                                    <input type="hidden"  class="form-control" id="idproducto" name="idproducto" placeholder="id" value="<?php echo $producto->getIdproducto();?>" required data-error="ingrese nombre de producto">
                                    <?php echo $producto->getIdproducto();?>
                                    </td>
                                    <td class="thumbnail-img">
                                    <img class="img-fluid" src="<?php echo $abmproducto->buscarImagenProducto($producto->getIdproducto(),$directorio);?>" alt="" width="96px"></a>
                                    <!-- <input type="file" class ="form-control" name="imagen" id="imagen"> -->
                                    </td>
                                    <td class="name-pr">
                                    <input type="text" class="form-control" id="pronombre" name="pronombre" placeholder="Nombre de producto" value="<?php echo $producto->getPronombre();?>" required data-error="ingrese nombre de producto">
                                        
                                    </td>
                                    <td class="price-pr">
                                    <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="<?php echo  $producto->getPrecio();?>"required data-error="ingrese precio">
                                    </td>
                                    <td class="cantidad-pr">
                                        
                                        <input name="procantstock" type="number" class="form-control"  value="<?php echo $producto->getProcantstock();?>" name="id">
                                    </td>
                                    <td class="deshabilitado">
                                    
                                        <?php 
                                        
                                        if ($producto->getProdeshabilitado()=="0000-00-00 00:00:00" || $producto->getProdeshabilitado()==NULL){
                                            echo "Disponible";
                                        }else{
                                            echo"Deshabilitado <br>".$producto->getProdeshabilitado();
                                        }
                                        
                                        
                                        ?><br>
                                        <select type="text" class="form-control" id="prodeshabilitado" name="prodeshabilitado" value=<?php echo $deshabilitado; ?>>
                                    <option value="NULL">
                                    Habilitado
                                    </option>    
                                    <option value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    Deshabilitado
                                    </option>                  
                                    </select>
                                    </td>
                                    <td class="remove-pr update-box">
                                        
                                            
                                            <button class="border-0 bg-white"  type="submit"><i class="fas fa-edit"></i></button>
                                        
                                    </td>
                                    <!--<td class="remove-pr">
                                    
                                         <a href="../accion/eliminarProducto.php?idproducto=<?php //echo $producto->getIdproducto()?>"><i class="fas fa-times"></i></a>
                                    </td>-->
                                </tr>
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
                                </form>
                                <?php 
                               }
                               ?>

                               
                            </tbody>
                        </table>
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