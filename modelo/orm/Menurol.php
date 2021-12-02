<?php

class Menurol{

private $idmenu; //objeto menu
private $idrol; //objeto rol
private $mensajeoperacion;


public function __construct(){
$this->idmenu=new Menu();
$this->idrol=new Rol();
$this->mensajeoperacion="";

}

public function getIdmenu()
{
return $this->idmenu;
}

public function setIdmenu($idmenu)
{
$this->idmenu = $idmenu;


}


public function getIdrol()
{
return $this->idrol;
}

public function setIdrol($idrol)
{
$this->idrol = $idrol;

}


public function getMensajeoperacion()
{
return $this->mensajeoperacion;
}


public function setMensajeoperacion($mensajeoperacion)
{
$this->mensajeoperacion = $mensajeoperacion;

}

public function setear($idmenu,$idrol){
$this->setIdmenu($idmenu);
$this->setIdrol($idrol);

}

public function cargar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getIdmenu()->getIdmenu();
    if ($base->Iniciar()) {
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                $row = $base->Registro();
                $idmenu= new Menu();
                $idmenu->setIdmenu($row['idmenu']);
                $idmenu->cargar();
                $idrol= new Rol();
                $idrol->setIdrol($row['idrol']);
                $idrol->cargar();
                $this->setear($idmenu, $idrol);
                $resp=true;
            }
        }
    } else {
        $this->setmensajeoperacion("menurol->listar: ".$base->getError());
    }
    return $resp;
  
}

public function insertar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="INSERT INTO menurol(idmenu,idrol)
        VALUES('".$this->getIdmenu()->getIdmenu()."','".$this->getIdrol()->getIdrol()."')";
        if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
          
            $resp = true;
        } else {
           $this->setmensajeoperacion("menurol->insertar: ".$base->getError());
        }
    } else {
       $this->setmensajeoperacion("menurol->insertar: ".$base->getError());
    }
    return $resp;
}

public function modificar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="UPDATE menurol SET idmenu='".$this->getIdmenu()->getIdmenu()."',idrol='".$this->getIdrol()->getIdrol().
    "' WHERE idmenu='".$this->getIdmenu()->getIdmenu()."'";
    if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
            $resp = true;
        } else {
            $this->setmensajeoperacion("menurol->modificar: ".$base->getError());
        }
    } else {
        $this->setmensajeoperacion("menurol->modificar: ".$base->getError());
    }
    return $resp;
}


public function eliminar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="DELETE FROM menurol WHERE idmenu=".$this->getIdmenu()->getIdmenu();
    if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
            return true;
        } else {
            $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
        }
    } else {
        $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
    }
    return $resp;
}

public static function listar($parametro=""){
    $arreglo = array();
    $base=new BaseDatos();
    $sql="SELECT * FROM menurol ";
    
    if ($parametro!="") {
        $sql.='WHERE '.$parametro;
    }
    $res = $base->Ejecutar($sql);
    if($res>-1){
        if($res>0){
            
            while ($row = $base->Registro()){
                
                $obj= new Menurol();
                $idmenu= new Menu();
                $idmenu->setIdmenu($row['idmenu']);
                $idmenu->cargar();
                $idrol= new Rol();
                $idrol->setIdrol($row['idrol']);
                $idrol->cargar();
                $obj->setear($idmenu, $idrol);
                
                array_push($arreglo, $obj);
            }

        }
        
    } else {
        //$this->setmensajeoperacion("Rol->listar: ".$base->getError());
    }

    return $arreglo;
}






}



?>