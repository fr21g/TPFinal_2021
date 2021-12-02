<?php

class Abmadmin{

    public function crearMenu($datos){
        $objMenu = new ABMMenu;
        $retorno = false;
        $menues=$objMenu->buscar(null);

        $existe=FALSE;
        foreach($menues as $menu){
            if($datos['menombre']==$menu->getMenombre()){
                $existe=TRUE;
            }
        }

        $datosMe = [];
        $datosMe['menombre'] = $datos['menombre'];
        $datosMe['medescripcion'] = $datos['medescripcion'];
        $datosMe['idpadre'] = null;
        $datosMe['medeshabilitado'] = date("Y-m-d H:i:s");

        if (!$existe && $objMenu->alta($datosMe)){
            $retorno = true;
        }
        return $retorno;
    }

    public function modificarMenu($datos){
        $objProducto= new ABMMenu();
        $retorno = false;

        $datoM = [];
        $datoM['idmenu'] = $datos['idmenu'];
        $datoM['menombre'] = $datos['menombre'];
        $datoM['medescripcion'] = $datos['medescripcion'];
        $datoM['idpadre'] = $datos['idpadre'];
        $datoM['medeshabilitado'] = NULL;

        if($objProducto->modificacion($datoM)){
            $retorno = true;
        }
        return $retorno;
    }

    public function habilitarMenu($datos){
        
        $objMenu= new ABMMenu();
        $retorno = false;
        $filtro['idmenu'] = $datos['idmenu'];
        $menues = $objMenu->buscar($filtro);
        foreach($menues as $menu){
            $menombre = $menu->getMenombre();
            $medescripcion = $menu->getMedescripcion();
            $idpadre = $menu->getIdpadre();
            $desha = $menu->getMedeshabilitado();
        }

        if($desha!='0000-00-00 00:00:00' || $desha!=NULL){
            $datoMA = [];
            $datoMA['idmenu'] = $datos['idmenu'];
            $datoMA['menombre'] = $menombre;
            $datoMA['medescripcion'] = $medescripcion;
            $datoMA['idpadre'] = $idpadre;
            $datoMA['medeshabilitado'] = null;

            if($objMenu->modificacion($datoMA)){
                //echo '<div class="alert alert-success" role="alert">Datos modificados con exito</div>';
                $retorno = true;
            }
        }
        return $retorno;
    }

    public function deshabilitarMenu($datos){

        $objMenu= new ABMMenu();
        $filtro['idmenu'] = $datos['idmenu'];
        $menues = $objMenu->buscar($filtro);
        foreach($menues as $menu){
            $menombre = $menu->getMenombre();
            $medescripcion = $menu->getMedescripcion();
            $idpadre = $menu->getIdpadre();
            $desha = $menu->getMedeshabilitado();
        }

        $retorno = false;
        if($desha=='0000-00-00 00:00:00' || $desha==NULL){
            
            $datoM = [];
            $datoM['idmenu'] = $datos['idmenu'];
            $datoM['menombre'] = $menombre;
            $datoM['medescripcion'] = $medescripcion;
            $datoM['idpadre'] = $idpadre;
            $datoM['medeshabilitado'] = date("Y-m-d H:i:s");
            
            if($objMenu->modificacion($datoM)){
                //echo '<div class="alert alert-success" role="alert">Datos modificados con exito</div>';
                $retorno = true;
            }
        }
        return $retorno;
    }

    public function crearUsuario($datos){
        $usuario = new ABMUsuario;

        $retorno = false;
        $usuarios=$usuario->buscar(null);

        $existe=FALSE;
        foreach($usuarios as $user){
            if($datos['usnombre']==$user->getUsnombre()){
                $existe=TRUE;
            }
        }

        $datosUs = [];
        $datosUs['usnombre'] =$datos['usnombre'];
        $datosUs['uspass'] = md5($datos['uspass']);
        $datosUs['usmail'] = $datos['usmail'];
        $datosUs['usdeshabilitado'] = null;

        if (!$existe && $usuario->alta($datosUs)){
            $usuarios=$usuario->buscar(null);
            $id = 0;
            foreach($usuarios as $user){
                if($datos['usnombre']==$user->getUsnombre()){
                    $id= $user->getIdusuario();
                }
                
            }

            $usuarioObjetoRol= new ABMUsuariorol();
            $idrol = $datos['idrol']; 
            $datosUsuarioRol = array();
            foreach ($idrol as $rol){
                $datosUsuarioRol['idusuario'] = $id;
                $datosUsuarioRol['idrol'] =  $rol;
                $usuarioObjetoRol->alta($datosUsuarioRol);
            }
            $retorno = true;
        }
        return $retorno;
    }

    public function modificarUsuario($datos){
        $abmusuario = new ABMUsuario();
        $Objusdes = $abmusuario->buscar($datos['idusuario']);
        $usdeshabilitado = $Objusdes[0]->getUsdeshabilitado();

        $datos['usnombre'] = $datos['usnombre'];
        $datos['uspass'] = md5($datos['uspass']);
        $datos['usmail'] = $datos['usmail'];
        $datos['usdeshabilitado']=$usdeshabilitado;

        $array=array();
        $abmUsuarioRol= new ABMUsuariorol();
        $usrol = $abmUsuarioRol->buscar($datos['idusuario']);

        $usuarios=$abmusuario->buscar(null);
        $existe=FALSE;
        foreach($usuarios as $user){
            if($datos['usnombre']==$user->getUsnombre()){
                $existe=TRUE;
            }
            
        }

        $retorno = false;
        if(isset($datos['listarol'])){
            if(count($usrol)>0){
                foreach($usrol as $rol){
                    $array=['idusuario'=>$datos['idusuario'],'idrol'=>$rol];
                    $roltrue=$abmUsuarioRol->baja($array);
                }
            }
            foreach($datos['listarol'] as $rol){
                $array=['idusuario'=>$datos['idusuario'],'idrol'=>$rol];
                $roltrue=$abmUsuarioRol->alta($array);
            }

            if(!$existe && $abmusuario->modificacion($datos) && $roltrue){
                //echo "datos modificados correctamente";
                //header('Location: ../paginas/gestionarUsuarios.php?rol=administrador');
                $retorno = true;
                
            }else{
                //echo "no se pudo modificar los datos, el nombre de usuario ya existe";
                //header('Location: ../paginas/gestionarUsuarios.php?rol=administrador');
            }
        }else{
            //echo "no hay roles asignados";
            //header('Location: ../paginas/gestionarUsuarios.php?rol=administrador');
        }
        return $retorno;
    }

    public function habilitarUsuario($datos){
        
        $objUsuario= new ABMUsuario();
        $filtro['idusuario'] = $datos['idusuario'];
        $usuarios = $objUsuario->buscar($filtro);
        foreach($usuarios as $usuario){
            $menombre = $usuario->getUsnombre();
            $medescripcion = $usuario->getUspass();
            $idpadre = $usuario->getUsmail();
            $desha = $usuario->getUsdeshabilitado();
        }

        $datoMA = [];
        $datoMA['idusuario'] = $datos['idusuario'];
        $datoMA['usnombre'] = $menombre;
        $datoMA['uspass'] = $medescripcion;
        $datoMA['usmail'] = $idpadre;
        $datoMA['usdeshabilitado'] = null;

        $retorno = false;
        if($objUsuario->modificacion($datoMA)){
            //echo '<div class="alert alert-success" role="alert">Datos modificados con exito</div>';
            $retorno = true;
        }
        return $retorno;
    }

    public function deshabilitarUsuario($datos){
        
        $objUsuario= new ABMUsuario();
        $filtro['idusuario'] = $datos['idusuario'];
        $usuarios = $objUsuario->buscar($filtro);
        foreach($usuarios as $usuario){
            $menombre = $usuario->getUsnombre();
            $medescripcion = $usuario->getUspass();
            $idpadre = $usuario->getUsmail();
            $desha = $usuario->getUsdeshabilitado();
        }
        
        $retorno = false;
        if($desha=='0000-00-00 00:00:00' || $desha==NULL){
            $datoMA = [];
            $datoMA['idusuario'] = $datos['idusuario'];
            $datoMA['usnombre'] = $menombre;
            $datoMA['uspass'] = $medescripcion;
            $datoMA['usmail'] = $idpadre;
            $datoMA['usdeshabilitado'] = date("Y-m-d H:i:s");

            if($objUsuario->modificacion($datoMA)){
                //echo '<div class="alert alert-success" role="alert">Datos modificados con exito</div>';
                $retorno = true;
            }
        }
        return $retorno;
    }

    public function crearRol($datos){

        $objRol= new ABMRol;
        $roles=$objRol->buscar(null);
        $existe=FALSE;
        foreach($roles as $rol){
            if($datos['rodescripcion']==$rol->getRodescript()){
                $existe=TRUE;
            }
        }
        $datosRol = [];
        $datosRol['rodescripcion'] = $datos['rodescripcion'];
        $retorno = false;
        if (!$existe && $objRol->alta($datosRol)){
            //echo "exito!";
            $retorno = true;
        }
        return $retorno;
    }

    public function editarRol($datos){
        
        $objRol= new ABMRol;
        $roles=$objRol->buscar(null);
        $existe=FALSE;
        if(count($roles)>0){
            foreach($roles as $rol){
                if($datos['rodescripcion']==$rol->getRodescript()){
                    $existe=TRUE;
                }
            }
        }

        $datosRol = [];
        $datosRol['idrol'] = $datos['idrol'];
        $datosRol['rodescripcion'] = $datos['rodescripcion'];
        $retorno = false;
        if (!$existe && $objRol->modificacion($datosRol)){
            //echo "exito!";
            $retorno = true;
        }
        return $retorno;
    }

    public function acepatarEnviarP($datos){
        
        $objEstado = new ABMCompraestado;
        $objEstadoTipo = new ABMCompraestadotipo();
        $objCompraItem = new Abmcompraitem();
        $objProducto = new Abmproducto();

        $estados = $objEstado->buscar($datos);
        $productos = $objProducto->buscar(null);
        $retorno = false;
        $resto=false;
        $resta=0;
        $compraitems = $objCompraItem->buscar(null);
        foreach($compraitems as $compraitem){
            foreach($productos as $producto){
                $idPro = $producto->getIdproducto();
                if($compraitem->getObjproducto()->getIdproducto() == $idPro){
                    $resta = $producto->getProcantstock()-$compraitem->getCicantidad();
                    $datosP = [];
                    $datosP['idproducto'] = $producto->getIdproducto();
                    $datosP['pronombre'] = $producto->getPronombre();
                    $datosP['prodetalle'] = $producto->getProdetalle();
                    $datosP['procantstock'] = $resta;
                    $datosP['precio'] = $producto->getPrecio();
                    $datosP['prodeshabilitado'] = $producto->getProdeshabilitado();
                    $objProducto->modificacion($datosP);
                    $resto = true;
                }
            }
        }

        $estadosTipos = $objEstadoTipo->buscar(null);
        foreach($estadosTipos as $tipo){
            if($tipo->getidcompraestadotipo() == "3"){
                $tipoE =  $tipo->getidcompraestadotipo();
            }
        }

        foreach($estados as $estado){
            $datosE=[];
            $datosE['idcompraestado'] = $estado->getIdCompraEstado();
            $datosE['idcompra'] = $estado->getObjcompra()->getIdCompra();
            $datosE['idcompraestadotipo'] = $tipoE;
            $datosE['cefechaini'] = $estado->getCefechaIni();
            $datosE['cefechafin'] = date("Y-m-d H:i:s");
        }
        if($resto && $objEstado->modificacion($datosE)){
            $items = $objCompraItem->buscar(null);
            foreach($items as $item){
                if($item->getObjcompra()->getIdcompra() == $estado->getObjcompra()->getIdCompra()){
                    $idItem['idcompraitem'] = $item->getIdcompraitem();
                    $objCompraItem->baja($idItem);
                    $retorno = true;
                }
            }
            //header("Location: ../paginas/gestionarCompras.php?rol=administrador");
        }
        return $retorno;
    }

    public function cancelarPedido($datos){
        $objEstado = new ABMCompraestado;
        $objEstadoTipo = new ABMCompraestadotipo();
        $objCompraItem = new Abmcompraitem();
        $estados = $objEstado->buscar($datos);
        $estadosTipos = $objEstadoTipo->buscar(null);
        $retorno = false;
        foreach($estadosTipos as $tipo){
            if($tipo->getidcompraestadotipo() == "4"){
                $tipoE =  $tipo->getidcompraestadotipo();
            }
        }

        foreach($estados as $estado){
            date_default_timezone_set("America/Buenos_Aires");
            $datosE=[];
            $datosE['idcompraestado'] = $estado->getIdCompraEstado();
            $datosE['idcompra'] = $estado->getObjcompra()->getIdCompra();
            $datosE['idcompraestadotipo'] = $tipoE;
            $datosE['cefechaini'] = $estado->getCefechaIni();
            $datosE['cefechafin'] = date("Y-m-d H:i:s");
        }
        if($objEstado->modificacion($datosE)){
            $items = $objCompraItem->buscar(null);
            foreach($items as $item){
                if($item->getObjcompra()->getIdcompra() == $estado->getObjcompra()->getIdCompra()){
                    $idItem['idcompraitem'] = $item->getIdcompraitem();
                    $objCompraItem->baja($idItem);
                    $retorno = true;
                }
            }
            //header("Location: ../paginas/gestionarCompras.php?rol=administrador");
        }
        return $retorno;
    }

}

?>