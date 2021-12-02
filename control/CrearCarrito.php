<?php

class CrearCarrito{

    public function precioP($param){
        $objProducto = new Abmproducto();
        $colPro = $objProducto->buscar($param); 
        $precio = 0;
        if(count($colPro)>0){
            foreach($colPro as $producto){
                if($param == $producto->getIdproducto()){
                    $precio = $producto->getPrecio();
                }
            }
        }
        return $precio;
    }

    public function aniadirCarrito($param){
        $session = new Session();
        $objItem = new Abmcompraitem();
        $objCompra = new Abmcompra();
        $objCompraEstado = new ABMCompraestado();

        $items = $objItem->buscar($param['idproducto']);
        $idP = "";
        $existePi = false;
        if(count($items)>0){
            
            foreach($items as $item){
                if($item->getObjproducto()->getIdproducto() == $param['idproducto']){
                    $idP = $item->getObjproducto()->getIdproducto();
                    $idIt = $item->getIdcompraitem();
                    //echo $idIt;
                    //echo $idP;
                    $existePi = true;
                }
                
                $ojI = $item->getObjcompra()->getIdcompra();
                
            }
        }
        echo $ojI;
        //echo $ojI->getIdcompraitem();
        $idC = 0;
        foreach($items as $item){
            $idC = $item->getObjcompra()->getIdcompra();
            
        }


        $crearcompras = $objCompra->buscar(null);
        if(count($crearcompras)>=0){
            $pC = false;
            $idUnaCompra = 0;
            $comprasEstado = $objCompraEstado->buscar(null);
            foreach($comprasEstado as $estado){
                $idUnaCompra = $estado->getObjcompra()->getIdcompra();  
            }
            foreach($crearcompras as $compraE){
                $idCompraE = $compraE->getIdcompra();
                
            }
            
            if(count($crearcompras)==0 || $idUnaCompra==$idCompraE){
                        date_default_timezone_set("America/Buenos_Aires");
                        $datoscompra=[];
                        $datoscompra['cofecha'] = date("Y-m-d H:i:s");
                        $datoscompra['idusuario'] = $session->getUsuario()->getIdusuario();
                        $datoscompra['preciofinal'] = 0;
                        if($objCompra->alta($datoscompra)){
                            echo "nueva compra agregada";
                            $pC = true;
                        }
            }else{
                //echo "error: no se agrego";
            }
            
            $compras = $objCompra->buscar(null);
            $añadido = false;
            $precioFinal = 0;
            if(count($compras)>=0){
                //echo $idCompraE;
                foreach($compras as $compra){
                    //echo "<br>".$param['idproducto'];
                    if(!is_null($compra->getObjusuario()->getIdusuario())){
                        echo "..";
                        if( $idP!=$param['idproducto'] || $idCompraE!=$idC && $ojI != $compra->getIdcompra()){
                            echo "creo?";
                            $p = $this->precioP($param['idproducto']);
                            $datos=[];
                            $datos['idcompraitem']= null;
                            $datos['idproducto']=$param['idproducto'];
                            $datos['idcompra']=$compra->getIdcompra();
                            $datos['cicantidad']=1;
                            $datos['preciototal']=$datos['cicantidad']*$p;
                            $precioFinal = $precioFinal+$datos['preciototal'];
                            $añadido = true;
                        }
                    }
                }
            }
            
        }
        $retorno = false;
        if($añadido && $objItem->alta($datos)){
            $retorno = true;
        }
        return $retorno;
    }

    public function editarCantProducto($datos){

        $objCompraItem = new AbmcompraItem();

        $carrito = new CrearCarrito();
        $datos = data_submitted();
        $cantidad = $datos['cantidad'];
        $filtro['idcompraitem'] = $datos['id'];

        $arrayItem = $objCompraItem->buscar($filtro);


        foreach($arrayItem as $item){
            if($cantidad<=$item->getObjproducto()->getProcantstock()){
                $idPro['idproducto'] = $item->getObjproducto()->getIdproducto();
                $p = $carrito->precioP($idPro['idproducto']);
                $datosM=[];
                $datosM['idcompraitem'] = $item->getIdcompraitem();
                $datosM['idproducto'] = $item->getObjproducto()->getIdproducto();
                $datosM['idcompra'] = $item->getObjcompra()->getIdcompra();
                $datosM['cicantidad'] = $cantidad;
                $datosM['preciototal'] = $cantidad*$p;
            }
        }
        $retorno=false;
        if($objCompraItem->modificacion($datosM)){
            if($cantidad<=0){
                $objCompraItem->baja($filtro);
            }
            $retorno = true;
        }
        return $retorno;
    }

    public function hacerPedido($datos){
        $objCompraEstado = new ABMCompraestado();
        $objCompraEstadoTipo = new ABMCompraestadotipo();
        $idCompra['idcompra'] = $datos['idcompra'];
        $filtro['idcompraestadotipo'] = 1;
        $compraEstadosTipo = $objCompraEstadoTipo->buscar($filtro);
        if(count($compraEstadosTipo)>0){
            foreach($compraEstadosTipo as $tipo){
                $idEstadoTipo = $tipo->getcetdetalle();
            }
        }

        $comprasEstado = $objCompraEstado->buscar($idCompra['idcompra']);

        $datosEstado = [];
        if(count($comprasEstado)>=0 ){
            $datosEstado['idcompraestado'] = "";
            $datosEstado['idcompra'] = $idCompra['idcompra'];
            $datosEstado['idcompraestadotipo'] = $datos['iniciada'];
            $datosEstado['cefechaini'] = date("Y-m-d H:i:s");
            $datosEstado['cefechafin'] = null;
        }
        $retorno = false;
        if($objCompraEstado->alta($datosEstado)){
            $retorno=true;
            //echo '<div class="alert alert-success" role="alert">Exito: Gracias por iniciar una compra!</div>';
        }//else{
            //echo '<div class="alert alert-danger" role="alert">Error: Esta compra esta ya fue iniciada</div>';
        //}
        return $retorno;
    }

}
?>