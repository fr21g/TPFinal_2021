<?php
include_once("../../configuracion.php");
include_once('../estructura/cabeceraNueva.php');
$objProdudcto=new Abmproducto();
$arreglo=$objProdudcto->buscar(null);
$directorio = "../../uploads/";

if($session->activa() && $datouser['rol'] == "cliente"){

?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Tienda</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->
<br>
<!-- Start Shop Page  -->
    
<div class="container col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
    <?php 
    /*$datos = data_submitted();
    if(isset($datos['rol'])){
        echo "<span class='text-success border border-success'>exito se añadio correctamente!</span>";
    }
    if(isset($datos[''])){
        echo "<span class='text-danger border border-danger'>No se pudo añadir al carrito ya fue agrado anteriormente!</span>";
    }*/
    ?>
    <div class="right-product-box">
        <div class="product-item-filter row">
            <div class="col-12 col-sm-8 text-center text-sm-left">
                <div class="toolbar-sorter-right">
                    <span>Elegir Productos</span>
                </div>
            </div>
        </div>

        <!--En cuedricula-->
        <div class="product-categorie-box">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                    <div class="row">
                        <?php
                        if(count($arreglo)>0){
                            $stock = false;
                            foreach ($arreglo as $producto){
                                if ($producto->getProdeshabilitado()=="0000-00-00 00:00:00" || $producto->getProdeshabilitado()==NULL){
                        ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                                
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">Venta</p>
                                    </div>
                                        <div>
                                        <?php
                                            
                                                echo '<img class="img-fluid" src="'.$objProdudcto->buscarImagenProducto($producto->getIdproducto(),$directorio).'"></a>';
                                        ?>
                                        </div>
                                        
                                        <div class="mask-icon">
                                            <a class="cart" href="../accion/aniadirCarrito.php?idproducto=<?php echo $producto->getIdproducto()?>">Añadir al carrito</a>
                                        </div>
                                </div>
                                <div class="why-text full-width">
                                    <h4><?php echo $producto->getPronombre()?></h4><h4>Quedan: <?php echo $producto->getProcantstock()?>kg.</h4>
                                    <h5>$<?php echo $producto->getPrecio()?>.00 x Kg.</h5>
                                </div>
                            </div>

                        </div>
                        <?php
                                $stock = true;
                                }
                                
                            }
                            if(!$stock){
                                echo "no hay stock de productos";
                            }
                        }else{
                            echo "no hay productos";
                        }
                        ?>
                    </div>

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
<!-- End Shop Page -->



<?php
include_once('../estructura/pie.php');
?>