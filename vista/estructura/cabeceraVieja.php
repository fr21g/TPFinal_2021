<?php
include_once('../../configuracion.php');
$session = new Session();
$objMenu = new ABMMenu();
$abmmenurol= new ABMMenurol();
$objCompraItem = new Abmcompraitem();
$items = count($objCompraItem->buscar(null)); // para obtener cantidad de items en el carrito
$datouser= data_submitted();
//$datouser['rol']="";
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
                        <ul>                        <?php
                            if (!$session->activa() /* || $datouser['rol']=="" */){
                                ?>
                            <li ><a id="iniciarsesion" href="<?php echo $objMenu->buscarHref('iniciarsesion')?>"><i class="fa fa-user s_color"></i> Iniciar Sesion</a></li>
                        <?php
                        }elseif($session->activa()){
                        ?>  
                        <li ><a href="#"><i class="fa fa-user s_color"><?php  $usuario = $session->getUsuario(); echo $usuario->getUsNombre();?></i>
                                    <ul>
                                        <li>
                                    <?php
                                        $usuario = $session->getUsuario();
                                        $session->getRol();
                                        $roles = $session->getRol();
                                        
                                        "<a href='#'>".$usuario->getUsNombre()."</a><br>";
                                        
                                        $menues = $objMenu->buscar(null);
                                    foreach($menues as $menu){
                                        foreach($roles as $rol){
                                            if($rol == $menu->getMenombre()){
                                                echo "<a href='?rol=".$rol."' >".$rol."</a><br>";
                                            }
                                        }

                                    }?>
                                    
                                    
                                   
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
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
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <?php 
                        
                        //print_r($datouser);
                        
                        $menues = $objMenu->buscar(null);
                        $menuroles = $abmmenurol ->buscar(null);
                        
                        if(!$session->activa()){ //si la sesion NO esta activa se cargan los menues publicos
                            foreach($menues as $menu){
                                if($menu->getMenombre()=="publico"){
                                    $idpadre = $menu->getIdmenu();
                                    
                                    
                                }
                                if($idpadre == $menu->getIdpadre()){
                                        
                                    echo "<li class='nav-item active'><a href='".$menu->getMedescripcion()."'>".$menu->getMenombre()."</a></li>";
                                    
                                }
                                
                            }
                            
                        }else{// si la sesion esta activa se cargan los menues segun el rol e id padre
                            foreach($menues as $menu){
                                if($menu->getIdpadre() != NULL){
                            echo "<li class='nav-item active'><a href='".$menu->getMedescripcion()."'>".$menu->getMenombre()."</a></li>";
                                }
                            }
                       /*   foreach($menues as $menu){
                                if($menu->getIdpadre() != NULL){
                                    foreach($menuroles as $menurol){
                                        if($menurol->getIdrol()->getId)
                                        echo "<li class='nav-item active'><a href='".$menu->getMedescripcion()."'>".$menu->getMenombre()."</a></li>";
                                    
                                
                                }
                            
                            }
                            } */
                           
                        
                                
                                
                            
                            
                        }
                        
                        
                    
                        ?>
                    
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                
                <!-- End Atribute Navigation -->
                </div>
            <!-- Start Side Menu -->
            <div class="side" <?php // echo $display;// echo $displayDeposito;// echo $displayAdmin;?>>
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><img src="../images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Delica omtantur </a></h6>
                            <p>1x - <span class="price">$80.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="../images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Omnes ocurreret</a></h6>
                            <p>1x - <span class="price">$60.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="../images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Agam facilisis</a></h6>
                            <p>1x - <span class="price">$40.00</span></p>
                        </li>
                        <li class="total" id="carrito">
                            <a href="<?php //echo $objMenu->buscarHref('carrito');?>" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>
                            <span class=""><strong>Total</strong>: $180.00</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    