<?php
class Abmdeposito{

    public function ingresarProducto($datos){
        //verificamos que no exista producto y la imagen

        $abmproducto = new Abmproducto();
        $nombre=false;
        $buscartodos = $abmproducto ->buscar(null);
        foreach($buscartodos as $producto){
            if($producto->getPronombre()== $datos['pronombre']){
                $nombre = true;
            }
        }

        $ingreso = false;
        if(!$nombre && $abmproducto->alta($datos)){
            $ingreso = true;
            echo '<div class="alert alert-success" role="alert">Producto ingresado al catálogo</div>';
            //header('location: ../paginas/productosDeposito.php?rol=deposito');
        }//else{
            //echo '<div class="alert alert-danger" role="alert">El producto ya se encuentra en el catálogo</div>';
            //header('location: ../paginas/productosDeposito.php?rol=deposito');
        //}
        return $ingreso;
    }

    public function modicarProducto($datos){
        $abmproducto = new Abmproducto();
        $retorno = false;
        //$file=$_FILES['imagen'];
        //$filename=$file['name'];

        $datosP = [];
        $datosP['idproducto'] = $datos['idproducto'];
        $datosP['pronombre'] = $datos['pronombre'];
        $datosP['prodetalle'] = $datos['prodetalle'];
        $datosP['procantstock'] = $datos['procantstock'];
        $datosP['precio'] = $datos['precio'];
        $datosP['prodeshabilitado'] = $datos['prodeshabilitado'];

        if($abmproducto->modificacion($datosP)){
            /*if($filename !=""){
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $ext=".".$extension;
                $directorio = "../../uploads/";
                $buscar = $abmproducto ->buscar($datos);
                $md5 = md5($buscar[0]->getIdproducto());
                copy($file['tmp_name'], $directorio.$md5.$ext);
            }*/
            $retorno = true;
        }
        return $retorno;
    }

}

