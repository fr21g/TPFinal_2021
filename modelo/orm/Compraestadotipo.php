<?php

class Compraestadotipo{
    
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;
    
    public function __construct(){
        $this->idcompraestadotipo=1;
        $this->cetdescripcion="";
        $this->cetdetalle="";
        $this->mensajeoperacion="";
    }

    public function getidcompraestadotipo(){
        return $this->idcompraestadotipo;
    }
    
    public function setidcompraestadotipo($idcompraestadotipo){
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function getcetdescripcion(){
        return $this->cetdescripcion;
    }

    public function setcetdescripcion($cetdetalle){
        $this->cetdetalle = $cetdetalle;
    }

    public function getcetdetalle(){
        return $this->cetdetalle;
    }

    public function setcetdetalle($cetdetalle){
        $this->cetdetalle = $cetdetalle;
    }
    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function setear($idcompraestadotipo,$cetdescripcion,$cetdetalle){
        $this->setidcompraestadotipo($idcompraestadotipo);
        $this->setcetdescripcion($cetdescripcion);
        $this->setcetdetalle($cetdetalle);
    }

    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql="SELECT * FROM compraestadotipo WHERE idcompraestadotipo = ".$this->getidcompraestadotipo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestadotipo(idcompraestadotipo,cetdescripcion,cetdetalle)
            VALUES(".$this->getIdCompraEstadotipo().",'".$this->getcetdescripcion()."','".$this->getcetdetalle()."' )";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
            $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestadotipo SET idcompraestadotipo='".$this->getidcompraestadotipo()."',cetdescripcion='". $this->getcetdescripcion().
        "',cetdetalle='".$this->getcetdetalle."'
        WHERE idcompraestadotipo=".$this->getidcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestadotipo WHERE idcompraestadotipo=".$this->getidcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestadotipo ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Compraestadotipo();
                    $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion($base->getError());
        }
    
        return $arreglo;
    }
}
?>