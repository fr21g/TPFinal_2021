<?php
include_once("../../configuracion.php");
$sesion = new Session();
$datos = data_submitted();

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
        $sesion->cerrar();
        header('Location: ../paginas/login.php');
        
        
    }else{
        //echo "no se pudo modificar los datos, el nombre de usuario ya existe";
        header('Location: ../index/index.php?rol=administrador');
    }
}else{
    //echo "no hay roles asignados";
    header('Location: ../index/index.php?rol=administrador');
}




?>

























