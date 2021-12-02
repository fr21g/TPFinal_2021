<?php 
include_once('../../configuracion.php');
$session = new Session();

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>TIENDA DE FRUTAS Y VERDURAS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    <!--Modal CSS-->
    <!--<link rel="stylesheet" href="../css/modal.css">-->

</head>
<style>

#menu ul a {
  display:block;
}

#menu ul li {
  position:relative;
}

#menu ul ul {
  display:none;
  position:absolute;
  z-index: 1000;
  background-color: #111;
}

#menu ul li:hover > ul {
  display:block;
}

</style>

<body>

    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link" id="menu">
                        <ul>
                            <?php
                            if (!$session->activa()){
                                ?>
                                <li><a href="../paginas/login.php"><i class="fa fa-user s_color"></i> Iniciar Sesion</a></li>
                                <?php
                            }elseif($session->activa()){
                                ?>
                                <li ><a href="#"><i class="fa fa-user s_color"></i>
                                    <?php
                                        $usuario = $session->getUsuario();
                                        $session->getRol();
                                        $roles = $session->getRol();
                                        echo $usuario->getUsNombre();
                                        
                                    ?></a>
                                    <ul>
                                        <li><a href="#"><br>
                                            <?php 
                                            if(count($roles)>0){
                                                foreach($roles as $r){
                                                    if($r == "administrador"){
                                                        echo $r;
                                                    }
                                                }
                                            }
                                            ?>
                                            </a>
                                            <a href="#"><br>
                                            <?php 
                                            if(count($roles)>0){
                                                foreach($roles as $r){
                                                    if($r == "deposito"){
                                                        echo $r;
                                                    }
                                                }
                                            }
                                            ?>
                                            </a>
                                            <a href="#"><br>
                                            <?php 
                                            if(count($roles)>0){
                                                foreach($roles as $r){
                                                    if($r == "cliente"){
                                                        echo $r;
                                                    }
                                                }
                                            }
                                            ?>
                                            </a>
                                            <a href="../paginas/configCuenta.php" id='..'><br>Gestion de cuenta</a>
                                            <a href="../accion/cerrarLogin.php"><br>cerrar sesion</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                            <li><a href="#"><i class="fas fa-location-arrow"></i> Donde Estamos</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Contactenos</a></li>
                        </ul>
                        
                    </div>
                    
                </div>
                
                
                
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> 20% De descuento usando COD2021
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% De descuento en BANANAS
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 10%! De descuento comprando Online
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50%! De descuento comprando mañana
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 10%! De descuento en Paltas!!!
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End Main Top -->
    
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light  navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="../index/index.php"><img width="65px" src="../images/logo2.png" class="logo" alt=""> Los tres Rabanitos</a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse bootsnav " id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="../index/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../paginas/nosotros.php">Sobre Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="../paginas/productos.php">productos</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" >CATALOGO</a>
                            <ul class="dropdown-menu">
								<li><a href="../paginas/tienda.php">Sidebar Shop</a></li>
								<li><a href="shop-detail.html">Shop Detail</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
                
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu">
							<a href="#">
								<i class="fa fa-shopping-bag"></i>
								<p>Mi Carrito</p>
							</a>
						</li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>

            <!-- Start Side Menu -->
            <div class="side">
                <?php
                $objPro = new Abmproducto();
                $objitem = new Abmcompraitem();
                $colItems = $objitem->buscar(null);
                $directorio = "../../uploads/";
                
                ?>
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <?php
                        $pF = 0;
                        foreach($colItems as $itemH){
                            $pF = $pF+$itemH->getPreciototal();
                        ?>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo $objPro->buscarImagenProducto($itemH->getObjproducto()->getIdproducto(),$directorio);?>" class="cart-thumb" alt="" /></a>
                            <h6><a href="#"><?php echo $itemH->getObjproducto()->getPronombre();?></a></h6>
                            <p><?php echo $itemH->getCicantidad();?>x - <span class="price"><?php echo $itemH->getPreciototal();?></span></p>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="total">
                            <a href="../paginas/carrito.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class=""><strong>Total</strong>: $<?php  echo $pF;?></span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

