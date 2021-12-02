<?php
include_once('../estructura/cabeceraNueva.php');
include_once('../../configuracion.php');
$objCompra = new Abmcompra();
$objCompraitem=new Abmcompraitem();
$objProducto = new Abmproducto();
$arreglo=$objCompraitem->buscar(null);

$directorio = "../../uploads/";

if($session->activa() && $datouser['rol'] == "cliente"){
?>


    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <?php

            $datos = data_submitted();
            if(isset($datos['true'])){
                echo "<span class='text-success border border-success'>exito se elimino correctamente!</span>";
            }
            if(isset($datos['false'])){
                echo "<span class='text-danger border border-danger'>No se pudo eliminar item!</span>";
            }
            
            if(isset($datos['modifytrue'])){
                echo "<span class='text-success border border-success'>Modificado Correctamente.</span>";
            }
            if(isset($datos['modifyfalse'])){
                echo "<span class='text-danger border border-danger'>No Modificado! no ha cambiado los kg que desea comprar.</span>";
            }
            
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Item</th>
                                    <th>Imagen</th>
                                    <th>Nombre del producto</th>
                                    <th>Precio</th>
                                    <th>kg.</th>
                                    <th>precio Total por kg.</th>
                                    <th>Cambiar Cantidad kg.</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $idusuario = $session->getUsuario()->getIdusuario();
                                $item = null;
                                $precioFinal = 0;
                                $mostrar = false;
                                if(count($arreglo)>0){
                                    $precioFinal = 0;
                                    foreach ($arreglo as $item){
                                        $idCompra['idcompra'] = $item->getObjcompra()->getIdcompra(); 

                                ?>
                                <form method="post" action="../accion/editarItemCarrito.php">
                                    <tr>
                                        <td class="thumbnail-img remove-pr" name="idcompraitem">
                                            <?php echo $item->getIdcompraitem();?>
                                        </td>
                                        <td class="thumbnail-img remove-pr">
                                            <img class="img-fluid" src="<?php echo $objProducto->buscarImagenProducto($item->getObjproducto()->getIdproducto(),$directorio);?>" alt="" width="96px"></a>
                                        </td>
                                        <td class="name-pr remove-pr">
                                            <?php echo $item->getObjproducto()->getPronombre();?>
                                        </td>
                                        <td class="price-pr remove-pr">
                                            <?php echo $item->getObjproducto()->getPrecio();?>
                                        </td>
                                        <td class="quantity-box ">
                                            <input name="cantidad" id="cantidad" type="number" value="<?php echo $item->getCicantidad();?>">
                                        </td>
                                        <td class="total-pr remove-pr">
                                        <?php echo $item->getPreciototal();?>
                                        </td>
                                        <td class="remove-pr update-box">
                                            <input type="hidden"  value="<?php echo $item->getIdcompraitem();?>" name="id"  > 
                                            <button class="border-0 bg-white" id="<?php echo $item->getIdcompraitem();?>" type="submit"><i class="fas fa-edit"></i></button>
                                        </td>
                                        <td class="remove-pr ">
                                            <a href="../accion/eliminarItemCarrito.php?idcompraitem=<?php echo $item->getIdcompraitem();?>" ><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                                $precioFinal = $precioFinal+$item->getPreciototal();
                                                $mostrar= true;
                                    }
                                }
                                if(!$mostrar){?>
                                    <td class="thumbnail-img">
                                        <?php echo "no hay Items en el carrito";?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <?php
                    
                    ?>
                    <!--<div class="row my-5">
                        <div class="col-lg-6 col-sm-6"></div>
                        <div class="col-lg-6 col-sm-6">
                            <form action>
                                <div class="update-box">
                                    <input value="Actualizar Compra" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>-->
                    <?php
                    
                    ?>
                </div>
                
            </div>
            
            
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3 >Resumen Compra</h3>
                        <div class="d-flex">
                            <?php
                                        if(!is_null($item)){
                                            
                                            date_default_timezone_set("America/Buenos_Aires");
                                            $datosc=[];
                                            $datosc['idcompra'] = $idCompra['idcompra'];
                                            $datosc['cofecha'] = date("Y-m-d H:i:s");
                                            $datosc['idusuario'] = $item->getObjcompra()->getObjusuario()->getIdusuario();
                                            $datosc['preciofinal'] = $precioFinal;
                                            $objCompra->modificacion($datosc);
                            ?>
                            <h4>ID Compra:<?php echo $item->getObjcompra()->getIdcompra();?><br>
                                ID Usuario:<?php echo $item->getObjcompra()->getObjusuario()->getIdusuario();
                                ?></h4>
                            
                        </div>
                        <div class="d-flex">
                            <h4>Fecha de compra: </h4>
                            <h4 ><?php echo $item->getObjcompra()->getCofecha(); 
                        ?> </h4>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Precio Final</h5>
                            <div class="ml-auto h5"> $<?php  echo $precioFinal;?>
                            </div>
                        </div>
                        <hr> 
                        <div class="row my-5">
                        <div class="col-lg-6 col-sm-6"></div>
                        <!--<div class="col-lg-6 col-sm-6">
                             <form metohd="post">
                                <div class="update-box">
                                <input  name="idcompra" type="hidden" value="" type="submit">
                                    <input name="idcompra" id="" value="Hacer Pedido" type="submit">
                                </div>
                            </form> 
                        </div>-->
                    </div>
                        <div class="col-12 d-flex shopping-box"><a href="../accion/iniciarPedido.php?idcompra=<?php echo $item->getObjcompra()->getIdcompra()?>&rol=cliente&iniciada=1" class="ml-auto btn hvr-hover">Hacer Pedido</a> </div>
                    <?php
                    }else{
                        echo "<div>no hay item En el carrito</div>";
                    }?>
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
    <!-- End Cart -->

<?php
include_once('../estructura/pie.php');
?>